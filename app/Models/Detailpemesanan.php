<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpemesanan extends Model
{
    use HasFactory;

    protected $table = 'ta_detail_pemesanan';
    protected $fillable = [
        "id_pemesanan",
        "id_produk",
        "qty",
        "total_harga",
    ];
    protected  $primaryKey = 'id_detail_pemesanan';
}
