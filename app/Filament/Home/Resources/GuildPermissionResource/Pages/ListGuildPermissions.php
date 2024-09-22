<?php

namespace App\Filament\Home\Resources\GuildPermissionResource\Pages;

use App\Filament\Home\Resources\GuildPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuildPermissions extends ListRecords
{
    protected static string $resource = GuildPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
