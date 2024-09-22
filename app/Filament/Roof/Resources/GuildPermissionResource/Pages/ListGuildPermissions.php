<?php

namespace App\Filament\Roof\Resources\GuildPermissionResource\Pages;

use App\Filament\Roof\Resources\GuildPermissionResource;
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
