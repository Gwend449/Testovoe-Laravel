<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents, HasFactory;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory(10)->create();
        \App\Models\Product::factory(100)->create();
    }
}


// TODO: SEEDER
// TODO: Controller + Service + Query + Architecture
