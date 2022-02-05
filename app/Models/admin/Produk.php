<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = [
        "id_kategori",
        "judul_produk",
        "deskripsi_produk",
        "merk_produk",
        "tahun_pembuatan_produk",
        "foto_produk_url",
        "harga_produk",
        "persediaan_awal",
        "persediaan_sisa",
    ];
    protected  $primaryKey = 'id_produk';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
