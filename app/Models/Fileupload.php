<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileupload extends Model
{
    use HasFactory;
    protected $table = 'ta_file';
    protected $fillable = [
        "id_pemesanan",
        "file_upload",
    ];
    protected  $primaryKey = 'id_detail_pemesanan';
}
