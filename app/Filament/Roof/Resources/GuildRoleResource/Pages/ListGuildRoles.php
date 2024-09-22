<?php

namespace App\Filament\Roof\Resources\GuildRoleResource\Pages;

use App\Filament\Roof\Resources\GuildRoleResource;
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
