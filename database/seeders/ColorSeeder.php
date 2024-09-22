<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            [
                'id' => 1,
                'name' => 'Varsayılan',
                'int' => 0,
                'hex' => '#000000'
            ],
            [
                'id' => 2,
                'name' => 'Aqua',
                'int' => 1752220,
                'hex' => '#1ABC9C'
            ],
            [
                'id' => 3,
                'name' => 'Koyu Aqua',
                'int' => 1146986,
                'hex' => '#11806A'
            ],
            [
                'id' => 4,
                'name' => 'Yeşil',
                'int' => 5763719,
                'hex' => '#57F287'
            ],
            [
                'id' => 5,
                'name' => 'Koyu Yeşil',
                'int' => 2067276,
                'hex' => '#1F8B4C'
            ],
            [
                'id' => 6,
                'name' => 'Mavi',
                'int' => 3447003,
                'hex' => '#3498DB'
            ],
            [
                'id' => 7,
                'name' => 'Koyu Mavi',
                'int' => 2123412,
                'hex' => '#206694'
            ],
            [
                'id' => 8,
                'name' => 'Mor',
                'int' => 10181046,
                'hex' => '#9B59B6'
            ],
            [
                'id' => 9,
                'name' => 'Koyu Mor',
                'int' => 7419530,
                'hex' => '#71368A'
            ],
            [
                'id' => 10,
                'name' => 'Parlak Canlı Pembe',
                'int' => 15277667,
                'hex' => '#E91E63'
            ],
            [
                'id' => 11,
                'name' => 'Koyu Canlı Pembe',
                'int' => 11342935,
                'hex' => '#AD1457'
            ],
            [
                'id' => 12,
                'name' => 'Altın',
                'int' => 15844367,
                'hex' => '#F1C40F'
            ],
            [
                'id' => 13,
                'name' => 'Koyu Altın',
                'int' => 12745742,
                'hex' => '#C27C0E'
            ],
            [
                'id' => 14,
                'name' => 'Turuncu',
                'int' => 15105570,
                'hex' => '#E67E22'
            ],
            [
                'id' => 15,
                'name' => 'Koyu Turuncu',
                'int' => 11027200,
                'hex' => '#A84300'
            ],
            [
                'id' => 16,
                'name' => 'Kırmızı',
                'int' => 15548997,
                'hex' => '#ED4245'
            ],
            [
                'id' => 17,
                'name' => 'Koyu Kırmızı',
                'int' => 10038562,
                'hex' => '#992D22'
            ],
            [
                'id' => 18,
                'name' => 'Gri',
                'int' => 9807270,
                'hex' => '#95A5A6'
            ],
            [
                'id' => 19,
                'name' => 'Koyu Gri',
                'int' => 9936031,
                'hex' => '#979C9F'
            ],
            [
                'id' => 20,
                'name' => 'Daha Koyu Gri',
                'int' => 8359053,
                'hex' => '#7F8C8D'
            ],
            [
                'id' => 21,
                'name' => 'Açık Gri',
                'int' => 12370112,
                'hex' => '#BCC0C0'
            ],
            [
                'id' => 22,
                'name' => 'Lacivert',
                'int' => 3426654,
                'hex' => '#34495E'
            ],
            [
                'id' => 23,
                'name' => 'Koyu Lacivert',
                'int' => 2899536,
                'hex' => '#2C3E50'
            ],
            [
                'id' => 24,
                'name' => 'Sarı',
                'int' => 16776960,
                'hex' => '#FFFF00'
            ],
            [
                'id' => 25,
                'name' => 'Beyaz (Varsayılan)',
                'int' => 16777215,
                'hex' => '#FFFFFF'
            ],
            [
                'id' => 26,
                'name' => 'Griple',
                'int' => 10070709,
                'hex' => '#99AAb5'
            ],
            [
                'id' => 27,
                'name' => 'Siyah',
                'int' => 2303786,
                'hex' => '#23272A'
            ],
            [
                'id' => 28,
                'name' => 'Koyu Ama Siyah Değil',
                'int' => 2895667,
                'hex' => '#2C2F33'
            ],
            [
                'id' => 29,
                'name' => 'Tamamen Siyah Değil',
                'int' => 2303786,
                'hex' => '#23272A'
            ],
            [
                'id' => 30,
                'name' => 'Maviye Çalan Mor',
                'int' => 5793266,
                'hex' => '#5865F2'
            ],
            [
                'id' => 31,
                'name' => 'Yeşil',
                'int' => 5763719,
                'hex' => '#57F287'
            ],
            [
                'id' => 32,
                'name' => 'Sarı',
                'int' => 16705372,
                'hex' => '#FEE75C'
            ],
            [
                'id' => 33,
                'name' => 'Pembe',
                'int' => 15418782,
                'hex' => '#EB459E'
            ],
            [
                'id' => 34,
                'name' => 'Kırmızı',
                'int' => 15548997,
                'hex' => '#ED4245'
            ],
            [
                'id' => 35,
                'name' => 'İsimsiz Rol Rengi 1',
                'int' => 6323595,
                'hex' => '#607D8B'
            ],
            [
                'id' => 36,
                'name' => 'İsimsiz Rol Rengi 2',
                'int' => 5533306,
                'hex' => '#546E7A'
            ],
            [
                'id' => 37,
                'name' => 'Arka Plan Siyah Rengi',
                'int' => 3553599,
                'hex' => '#36393F'
            ],
        ];

        foreach ($colors as $color)
        {
            Color::query()->updateOrCreate([
                'id' => $color['id'],
            ], $color);
        }

    }
}
