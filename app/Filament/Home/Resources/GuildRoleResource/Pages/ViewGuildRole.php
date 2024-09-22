<?php

namespace App\Filament\Home\Resources\GuildRoleResource\Pages;

use App\Filament\Home\Resources\GuildRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGuildRole extends ViewRecord
{
    protected static string $resource = GuildRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\EditAction::make(),
        ];
    }
}
