@extends('layouts.master')

@section('title', 'Detail Barang')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Data Barang</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Table Detail</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Full Width</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>Jenis Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $item->jenisBarang->nama_jenis_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td class="{{ $item->kondisi == 'Tersedia' ? 'badge badge-success' : 'badge badge-danger' }}">{{ $item->kondisi }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger" onclick="
                                                event.preventDefault();
                                                if (confirm('Do you want to remove this?')) {
                                                document.getElementById('delete-row-{{ $item->id }}').submit();
                                                }">
                                                delete
                                            </a>
                                            <form id="delete-row-{{ $item->id }}" action="{{ route('item.destroy', ['id' => $item->id]) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection