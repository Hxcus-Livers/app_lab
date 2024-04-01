@extends('layouts.master')

@section('title', 'Detail Barang')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('item.index') }}"><i class="fas fa-file"></i> Daftar Barang </a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Detail Data</li>
                </ol>
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
                            <table class="table table-striped table-md text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jenisBarang->nama_jenis_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_barang }} image" style="width: 100px; height: auto;">
                                            @else
                                            No Image Available
                                            @endif
                                        </td>
                                        <td class="{{ $item->status == 'Tersedia' ? 'badge badge-success' : 'badge badge-danger' }}  mt-2">{{ $item->status }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger" onclick="
                                                event.preventDefault();
                                                if (confirm('Do you want to remove this?')) {
                                                document.getElementById('delete-row-{{ $item->id }}').submit();
                                                }">
                                                <i class="fas fa-trash"></i>
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
                            {{ $barang->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection