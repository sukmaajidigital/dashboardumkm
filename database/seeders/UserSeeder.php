<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => '0',
            'nama_user' => '1',
            'name' => '1',
            'email' => '1@muriabatik.com',
            'password' => Hash::make('1'),
        ]);
        User::create([
            'role' => '0',
            'nama_user' => 'root',
            'name' => 'root',
            'email' => 'root@muriabatik.com',
            'password' => Hash::make('root123'),
        ]);
        User::create([
            'role' => '1',
            'nama_user' => 'admin',
            'name' => 'admin',
            'email' => 'admin@muriabatik.com',
            'password' => Hash::make('admin123'),
        ]);
        User::create([
            'role' => '2',
            'nama_user' => 'produksi',
            'name' => 'produksi',
            'email' => 'produksi@muriabatik.com',
            'password' => Hash::make('produksi123'),
        ]);
        User::create([
            'role' => '3',
            'nama_user' => 'owner',
            'name' => 'owner',
            'email' => 'owner@muriabatik.com',
            'password' => Hash::make('owner123'),
        ]);
        User::create([
            'role' => '4',
            'nama_user' => 'kasir',
            'name' => 'kasir',
            'email' => 'kasir@muriabatik.com',
            'password' => Hash::make('Kasir@0123'),
        ]);
    }
}
