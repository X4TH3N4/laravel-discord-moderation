<?php

namespace App\Filament\Home\Resources\GuildPermissionResource\Pages;

use App\Filament\Home\Resources\GuildPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGuildPermission extends ViewRecord
{
    protected static string $resource = GuildPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\EditAction::make(),
        ];
    }
}
