<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->integer('id_kategori')->unsigned();
            $table->string('judul_produk', 100);
            $table->text('deskripsi_produk');
            $table->text('merk_produk');
            $table->smallInteger('tahun_pembuatan_produk')->nullable();
            $table->text('foto_produk_url');
            $table->integer('harga_produk')->default(0);
            $table->smallInteger('persediaan_awal')->default('0');
            $table->smallInteger('persediaan_sisa')->default('0');
            $table->timestamps();
            $table->string('created_by')->default('');
            $table->string('updated_by')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
