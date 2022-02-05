<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $fillable = [
        "id_produk",
        "id_user",
        "qty",
        "total_harga"
    ];
    protected  $primaryKey = 'id_keranjang';
}
