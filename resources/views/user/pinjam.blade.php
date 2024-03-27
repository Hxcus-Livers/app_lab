@extends('layouts.user')

@section('title', 'Tambah Barang')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pinjam Barang</h1>
            <div class="section-header-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-pencil-alt"></i> Pinjam Barang</li>
                </ol>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Pinjam Barang</h2>

            <div class="row">
                <div class="col-11 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Isi Data Anda !!</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('requests.store') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="user_id">User ID:</label>
                                    <input type="number" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="item_name" class="form-label">Item Name:</label>
                                    <input type="text" class="form-control" id="item_name" name="item_name" value="{{ old('item_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="form-label">Quantity:</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                                </div>
                                <button type="submit" class="btn btn-primary" onclick="submitRequest()">Submit Request</button>

                                <script>
                                    function submitRequest() {
                                        const data = {
                                            // Extract form data (item_name, quantity, etc.)
                                            item_name: document.getElementById('item_name').value,
                                            quantity: document.getElementById('quantity').value,
                                            // ... other data
                                        };

                                        fetch('/api/requests', {
                                                method: 'POST',
                                                body: JSON.stringify(data),
                                                headers: {
                                                    'Content-Type': 'application/json'
                                                }
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    // Send FCM notification to admin
                                                    const notification = {
                                                        title: "Permintaan Barang Baru",
                                                        body: "Sebuah permintaan barang baru diajukan oleh " + data.user.nama,
                                                        data: {
                                                            type: "request_barang",
                                                            requestId: data.request.id,
                                                        },
                                                    };

                                                    fetch('/api/fcm/send', {
                                                            method: 'POST',
                                                            body: JSON.stringify(notification),
                                                            headers: {
                                                                'Content-Type': 'application/json'
                                                            }
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            console.log('FCM notification sent:', data);
                                                        })
                                                        .catch(error => {
                                                            console.error('Error sending FCM notification:', error);
                                                        });
                                                } else {
                                                    console.error('Error submitting request:', data.error);
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error sending request:', error);
                                            });
                                    }
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

@section('head')
@parent
<script src="https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.15.0/firebase-messaging.js"></script>
<script>
    // Your Firebase project configuration (replace with yours)
    var firebaseConfig = {
        // ... your firebase config details
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // Request permission for notifications
    const messaging = firebase.messaging();
    messaging.requestPermission()
        .then(() => {
            console.log('Notification permission granted.');
            // Get FCM token
            return messaging.getToken({
                vapidKey: 'YOUR_VAPID_KEY'
            });
        })
        .then((token) => {
            console.log('FCM token:', token);
            // Send token to server for association with user
            // (implementation depends on your backend)
        })
        .catch((error) => {
            console.error('Error getting permission:', error);
        });
</script>
@endsection