<?php

namespace App\Filament\Admin\Resources\MuteResource\Pages;

use App\Filament\Admin\Resources\MuteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMute extends ViewRecord
{
    protected static string $resource = MuteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
