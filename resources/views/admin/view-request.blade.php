@extends('layouts.master')

@section('title', 'Request Barang')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>View</h1>
            <div class="section-header-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file"></i> View Request </li>
                </ol>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Request</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Request Peminjamaan</h4>
                    </div>
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('error') }}
                        </div>
                    </div>
                    @endif
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md text-center">
                                <thead>
                                    <tr>
                                        <th> Nama </th>
                                        <th> Kelas</th>
                                        <th> Barang Yang diPinjam </th>
                                        <th> Total Barang </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request_user as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <form action="{{ route('request.updateStatus', $item->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                @if ($item->status === 'approved' && $item->disabled)
                                                <button type="submit" name="status" value="approved" class="btn btn-sm btn-success disabled">Approved</button>
                                                <button type="submit" name="status" value="pending" class="btn btn-sm btn-warning disabled">Pending</button>
                                                <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger disabled">Rejected</button>
                                                @else
                                                <button type="submit" name="status" value="approved" class="btn btn-sm btn-success">Approved</button>
                                                <button type="submit" name="status" value="pending" class="btn btn-sm btn-warning">Pending</button>
                                                <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger">Rejected</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection