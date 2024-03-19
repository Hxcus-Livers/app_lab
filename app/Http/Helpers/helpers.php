<?php

use App\Models\Barang;

function JenisBarang($barangId)
{
    $barang = Barang::find($barangId);
    return $barang->jenisBarang;
}

// ...

$barangId = 2;
$jenisBarang = JenisBarang($barangId);

// ... lanjutkan dengan proses selanjutnya
