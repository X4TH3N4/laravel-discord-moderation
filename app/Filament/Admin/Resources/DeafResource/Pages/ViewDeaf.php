<?php

namespace App\Filament\Admin\Resources\DeafResource\Pages;

use App\Filament\Admin\Resources\DeafResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDeaf extends ViewRecord
{
    protected static string $resource = DeafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
