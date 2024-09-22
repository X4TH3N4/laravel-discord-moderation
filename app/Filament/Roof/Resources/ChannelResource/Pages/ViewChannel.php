<?php

namespace App\Filament\Roof\Resources\ChannelResource\Pages;

use App\Filament\Roof\Resources\ChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewChannel extends ViewRecord
{
    protected static string $resource = ChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
