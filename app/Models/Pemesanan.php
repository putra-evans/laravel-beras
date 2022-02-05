<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'ta_pemesanan';
    protected $fillable = [
        "id_pemesanan",
        "id_user",
        "nama_penerima",
        "no_hp_penerima",
        "alamat_penerima",
        "provinsi_tujuan",
        "kota_tujuan",
        "berat_barang",
        "harga_barang",
        "jasa_kirim",
        "ongkir",
        "estimasi",
        "total_bayar",
        "status_pesanan",
        "no_resi"
    ];
    protected  $primaryKey = 'id_pemesanan';
}
