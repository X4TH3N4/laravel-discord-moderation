<?php

namespace App\Filament\Admin\Resources\DeafResource\Pages;

use App\Filament\Admin\Resources\DeafResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeaf extends EditRecord
{
    protected static string $resource = DeafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
