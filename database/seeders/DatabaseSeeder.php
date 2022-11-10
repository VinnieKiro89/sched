<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //user seeder
        DB::table('users')->insert([
            'fname' => 'Admin',
            'username' => 'admin1',
            'role' => 'Admin',
            'password' => Hash::make('admin1'),
        ]);
    }

    
}
