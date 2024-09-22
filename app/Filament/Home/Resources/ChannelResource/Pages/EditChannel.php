<?php

namespace App\Filament\Home\Resources\ChannelResource\Pages;

use App\Filament\Home\Resources\ChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChannel extends EditRecord
{
    protected static string $resource = ChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}