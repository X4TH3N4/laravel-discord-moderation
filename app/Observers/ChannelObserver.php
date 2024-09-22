<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Channel;
use App\Models\Guild;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ChannelObserver
{
    /**
     * Handle the Channel "created" event.
     * @throws \JsonException
     */
    public function created(Channel $channel)
    {
        $channel->owner_id = Auth::user()->id;
        $channel->guild_id = 1;
        if ($channel->type === 0) {
            $channel->name = Str::slug($channel->getOriginal('name'));
        }

        if($channel->category()->first())
        {
            $dc_id = (string)($channel->category()->first()->discord_id);
        } else {
            $dc_id = null;
        }

        $channel->saveQuietly();
        $response = Http::post(env('REQUEST_URL') . '/' . $channel->guild()->first()->discord_id . '/channels/create', [
            'channel' => [
                'guildId' => (string)($channel->guild()->first()->discord_id),
                'member_role_id' => '1154101726345969684',
                'name' => $channel->name,
                'topic' => $channel->topic,
                'type' => $channel->type,
                'nsfw' => $channel->nsfw,
                'owner_id' => (string)($channel->owner_id),
                'bitrate' => $channel->bitrate,
                'rateLimitPerUser' => $channel->cooldown,
                'position' => $channel->position,
                'userLimit' => $channel->user_limit,
                'parent' => $dc_id,
                'reason' => $channel->owner()->first()->name . ' tarafından Laravel Discord ile oluşturuldu.'
            ],
        ]);
//          ->body()
        $responseBody = $response->body();
        $json = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        $channel->discord_id = $json['discord_id'];
        $channel->saveQuietly();

    }

    public function creating(Channel $channel): void
    {

    }

    public function updating(Channel $channel): void
    {

    }


    /**
     * Handle the Channel "updated" event.
     */
    public function updated(Channel $channel): void
    {
        $response = Http::post(env('REQUEST_URL') . '/' . $channel->guild()->getResults()->discord_id . '/channels/edit', [
            'channel' => [
                'member_role_id' => '1154101726345969684',
                'guildId' => (string)($channel->guild()->getResults()->discord_id),
                'discord_id' => (string)($channel->discord_id),
                'name' => $channel->name,
                'topic' => $channel->topic,
                'nsfw' => $channel->nsfw,
                'owner_id' => (string)($channel->owner_id),
                'bitrate' => $channel->bitrate,
                'rateLimitPerUser' => $channel->cooldown,
                'position' => $channel->position,
                'userLimit' => $channel->user_limit,
                'parent' => (string)($channel->category()->first()->discord_id)
            ],
        ]);
    }

    /**
     * Handle the Channel "deleted" event.
     */
    public function deleted(Channel $channel): void
    {
        $response = Http::post(env('REQUEST_URL') . '/' . $channel->guild()->getResults()->discord_id . '/channels/delete', [
            'channel' => [
                'discord_id' => (string)($channel->discord_id)
            ],
        ]);
    }

    /**
     * Handle the Channel "restored" event.
     */
    public function restored(Channel $channel): void
    {
        //
    }

    /**
     * Handle the Channel "force deleted" event.
     */
    public function forceDeleted(Channel $channel): void
    {
        //
    }
}
