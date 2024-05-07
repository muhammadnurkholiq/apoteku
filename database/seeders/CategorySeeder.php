<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Categories = [
            ['name' => 'Analgesik'],
            ['name' => 'Antibiotik'],
            ['name' => 'Antihistamin'],
            ['name' => 'Antasida'],
        ];

        Category::insert($Categories);
    }
}
