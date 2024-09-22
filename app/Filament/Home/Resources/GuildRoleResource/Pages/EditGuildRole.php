<?php

namespace App\Filament\Home\Resources\GuildRoleResource\Pages;

use App\Filament\Home\Resources\GuildRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuildRole extends EditRecord
{
    protected static string $resource = GuildRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
//            Actions\DeleteAction::make(),
        ];
    }
}
