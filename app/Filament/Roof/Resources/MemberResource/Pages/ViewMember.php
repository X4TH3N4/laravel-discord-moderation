<?php

namespace App\Filament\Roof\Resources\MemberResource\Pages;

use App\Filament\Roof\Resources\MemberResource;
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
