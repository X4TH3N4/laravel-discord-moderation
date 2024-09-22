<?php

namespace App\Filament\Home\Resources\GuildResource\Pages;

use App\Filament\Home\Resources\GuildResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGuild extends ViewRecord
{
    protected static string $resource = GuildResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
