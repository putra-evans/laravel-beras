<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaDetailPemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta_detail_pemesanan', function (Blueprint $table) {
            $table->increments('id_detail_pemesanan');
            $table->integer('id_pemesanan')->unsigned();
            $table->integer('id_produk')->unsigned();
            $table->integer('qty');
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ta_detail_pemesanan');
    }
}
