@extends('layouts.user')

@section('title', 'Daftar Barang')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Table</h1>
      <div class="section-header-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard_user') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file"></i> Data Barang </li>
        </ol>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Table</h2>
      <p class="section-lead">Example of some Bootstrap table components.</p>
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Full Width</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md text-center">
                <thead>
                  <tr>
                    <th>Jenis Barang</th>
                    <th>Tersedia</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($jenis_barang as $item)
                  <tr>
                    <td>{{ $item->nama_jenis_barang }}</td>
                    <td>{{ $item->total_barang }}</td>
                    <td>
                      <a href="{{ route('low-user.detail', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
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