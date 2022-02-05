<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori_beras';

    protected $fillable = [
        "id_city",
        "nama_kategori",
        "ket_kategori"
    ];
    protected  $primaryKey = 'id_kategori';
}
