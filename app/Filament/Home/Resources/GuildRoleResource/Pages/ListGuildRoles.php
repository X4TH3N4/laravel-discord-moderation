<?php

namespace App\Filament\Home\Resources\GuildRoleResource\Pages;

use App\Filament\Home\Resources\GuildRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuildRoles extends ListRecords
{
    protected static string $resource = GuildRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
