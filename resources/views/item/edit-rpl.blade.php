@extends('layouts.master')

@section('title', 'Daftar Barang')

@section('content')
<h1>Edit Item</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('items.update', $item) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
    <label for="jenis_item">Jenis Item</label>
    <input type="text" name="jenis_item" id="jenis_item" class="form-control" value="{{ $item->jenis_item }}" required>
</div>
<div class="form-group">
    <label for="nama_item">Nama Item (Optional)</label>
    <input type="text" name="nama_item" id="nama_item" class="form-control" value="{{ $item->nama_item }}">
</div>
<div class="form-group">
    <label for="kondisi">Kondisi</label>
    <input type="text" name="kondisi" id="kondisi" class="form-control" value="{{ $item->kondisi }}" required>
</div>
<div class="form-group">
    <label for="deskripsi">Deskripsi (Optional)</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
</div>
<div class="form-group">
    <label for="total_barang">Total Barang</label>
    <input type="number" name="total_barang" id="total_barang" class="form-control" value="{{ $item->total_barang }}" required min="0">
</div>
<button type="submit" class="btn btn-primary">Update Item</button>
</form>

@endsection
