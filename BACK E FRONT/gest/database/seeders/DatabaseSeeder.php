<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'Ramed Mendes',
            'email' => 'rmendes@gmail.com',
            'password' => Hash::make('123123')
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
