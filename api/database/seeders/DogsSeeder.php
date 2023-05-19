<?php

namespace Database\Seeders;

use App\Models\Dog;
use Illuminate\Database\Seeder;

class DogsSeeder extends Seeder
{
    public function run(): void
    {
        Dog::factory()->create();
    }
}
