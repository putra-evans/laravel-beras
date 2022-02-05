<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk')->delete();
        DB::table('produk')->insert(
            array(
                0 =>
                array(
                    'id_produk' => 1,
                    'id_kategori' => 1,
                    'judul_produk' => 'Beras Maknyuss Asli Solok',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => 'Maknyuss',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/Merk-Beras-Maknyus_tly8jm.jpg',
                    'harga_produk' => '25000',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                ),
                1 =>
                array(
                    'id_produk' => 2,
                    'id_kategori' => 1,
                    'judul_produk' => 'Beras Paijo Nikmat',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => 'Paijo',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/cef62a0d4b_ev7hfl.jpg',
                    'harga_produk' => '22000',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                ),
                2 =>
                array(
                    'id_produk' => 3,
                    'id_kategori' => 2,
                    'judul_produk' => 'Beras Sania Enak',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => 'Sania',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/beras-sania-e1607569198559_mdcbtk.jpg',
                    'harga_produk' => '21000',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                ),
                3 =>
                array(
                    'id_produk' => 4,
                    'id_kategori' => 2,
                    'judul_produk' => 'Beras Fortune Solok Selatan',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => 'Fortune',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/fortune_fortune-beras--5-kg-_full04_ijyzjh.jpg',
                    'harga_produk' => '18000',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                ),
                4 =>
                array(
                    'id_produk' => 5,
                    'id_kategori' => 3,
                    'judul_produk' => 'Beras BMW Padang Panjang',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => 'BMW',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/beras-bmw-e1607569409306_tfuqm2.jpg',
                    'harga_produk' => '25000',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                ),
                5 =>
                array(
                    'id_produk' => 6,
                    'id_kategori' => 3,
                    'judul_produk' => 'Beras Diabetes Organik',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => 'Greenara',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/inv_9862f137-9ed0-4e5c-8edb-d0499c58aa11_688_688_v5wlli.jpg',
                    'harga_produk' => '24500',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                ),
                6 =>
                array(
                    'id_produk' => 7,
                    'id_kategori' => 4,
                    'judul_produk' => 'Beras Mentik Susu',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => '3B',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/beras-mentik-susu-e1607568276257_lp4zn5.jpg',
                    'harga_produk' => '21500',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                ),
                7 =>
                array(
                    'id_produk' => 8,
                    'id_kategori' => 5,
                    'judul_produk' => 'Lumbung Padi Indonesia',
                    'deskripsi_produk' => 'Beras yang nikmat dan enak saat dimasak, dengan kualitas terjamin dan bermutu, dirawat dengan sepenuh hati dan dengan cinta kasih, sehingga mengahasilkan beras yang nikmat dan enak, nasi nya lebih putih dan tidak lengket',
                    'merk_produk' => 'Lumbung',
                    'tahun_pembuatan_produk' => '2022',
                    'foto_produk_url' => 'https://res.cloudinary.com/poakboco/image/upload/v1641443181/jual_beras/batch-upload_7a2ee374-02c4-4836-af6d-89ab15a4e949_g6arlk.jpg',
                    'harga_produk' => '18500',
                    'persediaan_awal' => 500,
                    'persediaan_sisa' => 500,
                    'created_at' => null,
                    'updated_at' => null,
                )
            )
        );
    }
}
