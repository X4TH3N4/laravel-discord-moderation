<?php

namespace App\Filament\Roof\Resources\GuildResource\Pages;

use App\Filament\Roof\Resources\GuildResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuilds extends ListRecords
{
    protected static string $resource = GuildResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
