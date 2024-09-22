<?php

namespace App\Filament\Admin\Resources\DeafResource\Pages;

use App\Filament\Admin\Resources\DeafResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeafs extends ListRecords
{
    protected static string $resource = DeafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
