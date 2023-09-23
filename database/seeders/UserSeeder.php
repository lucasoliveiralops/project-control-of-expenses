<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**s
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Lucas Oliveira",
            'email' => 'lucasoliveiralops@gmail.com',
            'password' => Hash::make('lucasoliveiralops@gmail.com'),
        ]);
    }
}
