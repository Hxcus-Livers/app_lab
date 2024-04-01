<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\JenisBarang;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'barang';

    protected $fillable = [
        'jenis_barang_id',
        'nama_barang',
        'deskripsi',
        'total',
        'image',
        'created_at',
        'updated_at'
    ];

    public function jenisBarang(): BelongsTo
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }
    
}
