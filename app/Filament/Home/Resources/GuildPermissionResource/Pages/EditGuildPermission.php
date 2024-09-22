<?php

namespace App\Filament\Home\Resources\GuildPermissionResource\Pages;

use App\Filament\Home\Resources\GuildPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuildPermission extends EditRecord
{
    protected static string $resource = GuildPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
//            Actions\DeleteAction::make(),
        ];
    }
}
