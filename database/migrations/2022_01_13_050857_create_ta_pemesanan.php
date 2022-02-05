<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaPemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta_pemesanan', function (Blueprint $table) {
            $table->increments('id_pemesanan');
            $table->integer('id_user')->unsigned();
            $table->string('nama_penerima', 100);
            $table->string('no_hp_penerima', 100);
            $table->text('alamat_penerima');
            $table->text('provinsi_tujuan');
            $table->text('kota_tujuan');
            $table->text('berat_barang');
            $table->text('harga_barang');
            $table->text('jasa_kirim');
            $table->text('ongkir');
            $table->text('estimasi');
            $table->text('total_bayar');
            $table->string('status_pesanan');
            $table->string('no_resi')->nullable();
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
        Schema::dropIfExists('ta_pemesanan');
    }
}
