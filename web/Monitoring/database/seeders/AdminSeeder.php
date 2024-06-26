<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            'nama' => 'Admin1', // Menggunakan 'nama' sesuai dengan kolom yang ada di tabel database
            'password' => bcrypt('12345678'), // Menggunakan bcrypt untuk menyandikan password
            'role' => 'Admin',
        ]);

        DB::table('admin')->insert([
            'nama' => 'Superadmin', // Menggunakan 'nama' sesuai dengan kolom yang ada di tabel database
            'password' => bcrypt('87654321'), // Menggunakan bcrypt untuk menyandikan password
            'role' => 'Superadmin',
        ]);
    }
}
