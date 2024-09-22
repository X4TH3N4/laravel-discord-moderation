<?php

namespace App\Filament\Admin\Resources\SettingResource\Pages;

use App\Filament\Admin\Resources\SettingResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;
use App\Models\Bot;
use App\Models\GuildRole;
use Closure;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Contracts\HasFileAttachments;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Exceptions\Halt;
use Filament\Resources\Pages\EditRecord as BaseEdit;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Wallo\FilamentSelectify\Components\ToggleButton;

class ListSettings extends ListRecords
{

    protected static string $resource = SettingResource::class;


    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

}
