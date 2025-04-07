<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\Category::factory(5)->create();
         \App\Models\News::factory(30)->create();

         \App\Models\User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'super-admin@yopmail.com',
             'phone' => '0989581167',
             'password' => bcrypt('123123123'),
             'role' => 'SUPER_ADMIN',
             'ip' => '127.0.0.1',
         ]);
    }
}
