<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    protected $table = 'peminjam';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'kelas',
        'alamat',
        'email',
        'barang_dipinjam',
        'total_barang',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status',
        'catatan',
        'created_at'

    ];
}
