<?php

namespace App\Filament\Admin\Resources\RequestResource\Pages;

use App\Filament\Admin\Resources\RequestResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequest extends EditRecord
{
    protected static string $resource = RequestResource::class;

    protected function getRedirectUrl(): string
    {
        return self::getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        if (User::isAdmin()) {

            return [
                Actions\ViewAction::make(),
                Actions\DeleteAction::make(),
            ];
        }

            return [];

    }
}
