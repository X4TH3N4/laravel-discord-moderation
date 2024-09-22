<?php

namespace App\Filament\Admin\Resources\RequestResource\Pages;

use App\Filament\Admin\Resources\RequestResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRequest extends ViewRecord
{
    protected static string $resource = RequestResource::class;

    protected function getHeaderActions(): array
    {
        if (User::isAdmin())
        {
            return [
                Actions\DeleteAction::make()
//                Actions\EditAction::make(),
            ];
        }
        return [];
    }

}
