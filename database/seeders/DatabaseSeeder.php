<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TaskSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'ibrahim',
        //     'email' => 'ibrahim@gmail.com',
        //     'password' => Hash::make('1234')
        // ]);

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
