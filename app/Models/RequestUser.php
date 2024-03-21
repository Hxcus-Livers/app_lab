<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    protected $table = 'peminjam';

    protected $fillabel = [
        'id',
        'nama',
        'kelas',
        'alamat',
        'email',
        'barang_dipinjam',
        'total_barang'
    ];
}
