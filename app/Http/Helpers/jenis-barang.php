<?php

use App\Models\Barang;

function JenisBarangByBarangId($barangId)
{
    $barang = Barang::find($barangId);
    return $barang->jenisBarang;
}

// ...

require_once 'jenis-barang.php';

$barangId = 2;
$jenisBarang = JenisBarangByBarangId($barangId);

// ... lanjutkan dengan proses selanjutnya
