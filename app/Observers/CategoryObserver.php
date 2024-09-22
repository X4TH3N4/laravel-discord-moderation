<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     * @throws \Exception
     */
    public function created(Category $category): void
    {

        $userData = [
            [
                'category_id' => $category->id,
                'member_id' => 1,
            ],
            [
                'category_id' => $category->id,
                'member_id' => 2,
            ]
        ];
        $ownerData = [
            [
                'category_id' => $category->id,
                'member_id' => 2,
            ],
        ];

        $category->type = 4;
        $category->owner_id = Auth::user()->id;
        DB::table('category_owners')->insert($ownerData);
        DB::table('category_members')->insert($userData);

        $discord_id = $category->owners()->get(['discord_id'])->pluck('discord_id');
        $discord_123 = $category->members()->get(['discord_id'])->pluck('discord_id');
        $response = Http::post(env('REQUEST_URL') . '/' . $category->guild()->first()->discord_id . '/categories/create', [
            'category' => [
                'member_role_id' => '1154101726345969684',
                'owners' => $discord_id,
                'members' => $discord_123,
                'guildId' => (string)($category->guild()->first()->discord_id),
                'name' => $category->name,
                'type' => $category->type,
                'position' => $category->position,
                'owner_id' => (string)($category->owner_id),
                'reason' => $category->owner()->first()->name . ' tarafından Laravel Discord ile oluşturuldu.'
            ],
        ]);

        $responseBody = $response->body();
        $json = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        $category->discord_id = $json['discord_id'];
        $category->category_mod_role_id = $json['category_mod_role_id'];
        $category->category_user_role_id = $json['category_user_role_id'];
        $category->saveQuietly();
    }

    public function creating(Category $category): void
    {

    }

    public function updating(Category $category): void
    {

    }


    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $response = Http::post(env('REQUEST_URL') . '/' . $category->guild()->first()->discord_id . '/categories/edit', [
            'category' => [
                'guildId' => (string)($category->guild()->first()->discord_id),
                'owner_id' => (string)($category->owner_id),
                'discord_id' => (string)($category->discord_id),
                'name' => $category->name,
                'position' => $category->position
            ],
        ]);
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $response = Http::post(env('REQUEST_URL') . '/' . $category->guild()->first()->discord_id . '/categories/delete', [
            'category' => [
                'guildId' => (string)($category->guild()->first()->discord_id),
                'discord_id' => (string)($category->discord_id),
                'category_mod_role_id' => (string)($category->category_mod_role_id),
                'category_user_role_id' => (string)($category->category_user_role_id),
            ],
        ]);
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
