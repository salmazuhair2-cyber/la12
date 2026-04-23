<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            [
                'name' => 'Clothing',
                'description' => 'Apparel and outfits for all genders.',
                'image' => 'https://picsum.photos/seed/clothing/200/200',
            ],
            [
                'name' => 'Footwear',
                'description' => 'Shoes, sandals, and more.',
                'image' => 'https://picsum.photos/seed/footwear/200/200',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Bags, jewelry, hats, and more.',
                'image' => 'https://picsum.photos/seed/accessories/200/200',
            ],
        ];

        foreach ($categories as $data) {
            $category = Category::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);

            $category->image()->create([
                'path' => $data['image'],
                'type' => 'main',
            ]);
        }
    }
}
