<?php

namespace App\Filament\Home\Resources\MemberResource\Pages;

use App\Filament\Home\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMember extends ViewRecord
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\EditAction::make(),
        ];
    }
}
