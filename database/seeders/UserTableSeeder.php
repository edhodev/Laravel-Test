<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Schema;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::create([
            'name' => 'Ridho Pangestu',
            'username' => 'rdhdev',
            'address' => 'Makassar',
            'phone' => '0895800710500',
            'email' => 'ridho.pangestu@outlook.com',
            'role' => 'Admnistrator',
            'type' => 'Internal',
            'password' => Hash::make('password123')
        ]);
        User::create([
            'name' => 'Finance User',
            'username' => 'userfinance',
            'address' => 'Makassar',
            'phone' => '0895800710500',
            'email' => 'finance@outlook.com',
            'role' => 'Finance',
            'type' => 'Internal',
            'password' => Hash::make('password123')
        ]);
        User::create([
            'name' => 'User Editor',
            'username' => 'usereditor',
            'address' => 'Makassar',
            'phone' => '0895800710500',
            'email' => 'editor@outlook.com',
            'role' => 'Editor',
            'type' => 'Internal',
            'password' => Hash::make('password123')
        ]);
    }
}
