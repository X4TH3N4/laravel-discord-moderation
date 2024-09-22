<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        $message->user_id = Auth::user()->id;
        $message->category_id = $message->channel()->first()->category_id;
        $message->saveQuietly();

        $response = Http::post(env('REQUEST_URL') . '/' . $message->guild()->getResults()->discord_id . '/channels/messages/create', [
            'message' => [
                'guildId' => (string)($message->guild()->getResults()->discord_id),
                'channelId' =>(string)($message->channel()->getResults()->discord_id),
                'content' => (string)($message->content)
            ],
        ]);

        $responseBody = $response->body();
        $json = json_decode($responseBody, true, 512, JSON_THROW_ON_ERROR);
        $message->discord_id = $json['discord_id'];
        $message->saveQuietly();

    }

    public function creating(Message $message): void
    {

    }

    public function updating(Message $message): void
    {

    }

    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        $response = Http::post(env('REQUEST_URL') . '/' . $message->guild()->getResults()->discord_id . '/channels/messages/edit', [
            'message' => [
                'guildId' => (string)($message->guild()->getResults()->discord_id),
                'channelId' =>(string)($message->channel()->getResults()->discord_id),
                'content' => (string)($message->content),
                'discord_id' => (string)($message->discord_id)
            ],
        ]);
    }

    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        $response = Http::post(env('REQUEST_URL') . '/' . $message->guild()->getResults()->discord_id . '/channels/messages/delete', [
            'message' => [
                'guildId' => (string)($message->guild()->getResults()->discord_id),
                'channelId' =>(string)($message->channel()->getResults()->discord_id),
                'discord_id' => (string)($message->discord_id)
            ],
        ]);
    }

    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
