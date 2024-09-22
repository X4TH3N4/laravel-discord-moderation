<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private $categories = [
        [
            'id' => 1155152306199859271,
            'name' => 'Moderasyon Kategorisi',
            'guild_id' => 1148179347325333564,
            'type' => 4,
            'position' => 1
        ],
        [
            'id' => 1155152327334952971,
            'name' => 'Log Kategorisi',
            'guild_id' => 1148179347325333564,
            'type' => 4,
            'position' => 2
        ],
        [
            'id' => 1155152355080290364,
            'name' => 'Ana Kategori',
            'guild_id' => 1148179347325333564,
            'type' => 4,
            'position' => 0
        ]

    ];


    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::query()->updateOrCreate([
                'id' => $category['id'],
            ], $category);
        }
    }
}
