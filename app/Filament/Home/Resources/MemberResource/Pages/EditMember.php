<?php

namespace App\Filament\Home\Resources\MemberResource\Pages;

use App\Filament\Home\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMember extends EditRecord
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
//            Actions\DeleteAction::make(),
        ];
    }
}
