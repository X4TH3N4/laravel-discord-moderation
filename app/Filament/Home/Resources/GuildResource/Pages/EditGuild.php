<?php

namespace App\Filament\Home\Resources\GuildResource\Pages;

use App\Filament\Home\Resources\GuildResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuild extends EditRecord
{
    protected static string $resource = GuildResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
