<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $members = [
        [
            'id' => 1,
            'discord_id' => '339375543038377986',
            'nick' => 'Berk',
            'avatar' => 'berk.png'
        ],
        [
            'id' => 2,
            'discord_id' => '139417524956561409',
            'nick' => 'Burak',
            'avatar' => 'burak.png'
        ]

    ];


    public function run(): void
    {
        foreach ($this->members as $member) {
            Member::query()->updateOrCreate([
                'id' => $member['id'],
            ], $member);
        }
    }
}
