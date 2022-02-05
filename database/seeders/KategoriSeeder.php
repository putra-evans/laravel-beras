<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_beras')->delete();
        DB::table('kategori_beras')->insert(
            array(
                0 =>
                array(
                    'id_kategori' => 1,
                    'id_city' => 420,
                    'nama_kategori' => 'Sokan',
                    'ket_kategori' => 'Sokan merupakan beras terbaik yang selalu nyaman untuk dimakan',
                    'created_at' => null,
                    'updated_at' => null,
                ),
                1 =>
                array(
                    'id_kategori' => 2,
                    'id_city' => 420,
                    'nama_kategori' => 'IR 64',
                    'ket_kategori' => 'IR 64 merupakan beras terbaik yang selalu nyaman untuk dimakan',
                    'created_at' => null,
                    'updated_at' => null,
                ),
                2 =>
                array(
                    'id_kategori' => 3,
                    'id_city' => 420,
                    'nama_kategori' => 'IR 42',
                    'ket_kategori' => 'IR 42 merupakan beras terbaik yang selalu nyaman untuk dimakan',
                    'created_at' => null,
                    'updated_at' => null,
                ),
                3 =>
                array(
                    'id_kategori' => 4,
                    'id_city' => 420,
                    'nama_kategori' => 'Cisokan',
                    'ket_kategori' => 'Cisokan merupakan beras terbaik yang selalu nyaman untuk dimakan',
                    'created_at' => null,
                    'updated_at' => null,
                ),
                4 =>
                array(
                    'id_kategori' => 5,
                    'id_city' => 420,
                    'nama_kategori' => 'Anak daro',
                    'ket_kategori' => 'Anak daro merupakan beras terbaik yang selalu nyaman untuk dimakan',
                    'created_at' => null,
                    'updated_at' => null,
                ),
                5 =>
                array(
                    'id_kategori' => 6,
                    'id_city' => 420,
                    'nama_kategori' => 'Caredek',
                    'ket_kategori' => 'Caredek merupakan beras terbaik yang selalu nyaman untuk dimakan',
                    'created_at' => null,
                    'updated_at' => null,
                )
            ),
        );
    }
}
