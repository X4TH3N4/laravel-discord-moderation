<?php

namespace App\Filament\Admin\Resources\MuteResource\Pages;

use App\Filament\Admin\Resources\MuteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMute extends EditRecord
{
    protected static string $resource = MuteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
