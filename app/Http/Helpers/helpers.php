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
function diffForHumans($date) {
    if (!$date) {
      return 'N/A (No date available)';
    }
  
    $now = new DateTime();
    $interval = $now->diff($date);
    $elapsed = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;
  
    if ($elapsed < 1) {
      return 'Baru saja';
    } elseif ($elapsed < 60) {
      return $elapsed . ' menit yang lalu';
    } elseif ($elapsed < 120) {
      return 'Sekitar 1 jam yang lalu';
    } elseif ($elapsed < (24 * 60)) {
      return round($elapsed / 60) . ' jam yang lalu';
    } elseif ($elapsed < (2 * 24 * 60)) {
      return 'Kemarin';
    } else {
      return round($elapsed / (24 * 60)) . ' hari yang lalu';
    }
  }
  
