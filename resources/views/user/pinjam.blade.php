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
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


@endsection