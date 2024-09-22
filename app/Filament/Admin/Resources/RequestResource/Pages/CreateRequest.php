<?php

namespace App\Filament\Admin\Resources\RequestResource\Pages;

use App\Filament\Admin\Resources\RequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRequest extends CreateRecord
{
    protected static string $resource = RequestResource::class;

    protected function getRedirectUrl(): string
    {
        return self::getResource()::getUrl('index');
    }


}
