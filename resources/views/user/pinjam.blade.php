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

                            <form action="{{ route('request.store') }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="barang_dipinjam" class="form-label">Barang yang di Pinjam</label>
                                    <textarea class="form-control" id="barang_dipinjam" name="barang_dipinjam" rows="3">{{ old('barang_dipinjam') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="total_barang" class="form-label">Total Barang yang di Pinjam</label>
                                    <input type="number" class="form-control" id="total_barang" name="total_barang" value="{{ old('total_barang') }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


@endsection