<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert(
            array(
                0 =>
                array(
                    'name' => 'admin',
                    'guard_name' => 'web'
                ),
                1 =>
                array(
                    'name' => 'user',
                    'guard_name' => 'web'
                )
            )
        );
    }
}
