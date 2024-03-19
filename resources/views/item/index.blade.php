@extends('layouts.master')

@section('title', 'Daftar Barang')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Table</h1>
      <div class="section-header-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file"></i> Data Barang </li>
        </ol>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Daftar Barang</h2>
      <p class="section-lead">Example of some Bootstrap table components.</p>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Jenis Barang</h4>
          </div>
          @if (session('success'))
          <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              {{ session('success') }}
            </div>
          </div>
          @endif

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
              <table class="table table-striped table-md">
                <thead>
                  <tr>
                    <th>Jenis Barang</th>
                    <th>Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($jenis_barang as $item)
                  <tr>
                    <td>{{ $item->nama_jenis_barang }}</td>
                    <td>{{ $item->total }}</td>
                    <td>
                      <a href="{{ route('item.detail', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
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