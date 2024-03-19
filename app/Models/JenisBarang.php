<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Barang;


class JenisBarang extends Model
{

    // protected $primaryKey = 'id_jenis_barang';
    // public $incrementing = false;
    protected $table = 'jenis_barang';

    protected $fillable = [
        'id',
        'nama_jenis_barang',
        'total',
        'updated_at'
    ];

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class, 'jenis_barang_id');
    }
}
