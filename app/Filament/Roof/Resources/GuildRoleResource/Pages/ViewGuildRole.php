<?php

namespace App\Filament\Roof\Resources\GuildRoleResource\Pages;

use App\Filament\Roof\Resources\GuildRoleResource;
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
