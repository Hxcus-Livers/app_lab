@extends('layouts.master')

@section('title', 'Tambah Barang')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Data</h1>
      <div class="section-header-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-plus"></i> Tambah Barang</li>
        </ol>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Form Tambah Barang</h2>

      <div class="row">
        <div class="col-11 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Tambahkan Barang</h4>
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

              <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                  <label for="jenis_barang_id" class="form-label">Jenis Barang</label>
                  <select class="form-control" id="jenis_barang_id" name="jenis_barang_id">
                    @foreach ($jenisBarang as $jenisBarang)
                    <option value="{{ $jenisBarang->id }}">{{ $jenisBarang->nama_jenis_barang }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="nama_barang" class="form-label">Nama Barang</label>
                  <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                </div>

                <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                  <label for="total" class="form-label">Jumlah</label>
                  <input type="number" class="form-control" id="total" name="total" value="{{ old('total') }}">
                </div>

                <div class="mb-3">
                  <label class="form-label">Upload Fils / Image</label>
                  <input type="file" name="image" class="form-control">
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