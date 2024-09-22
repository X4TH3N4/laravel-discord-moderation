<?php

namespace App\Enums\Request;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum : string implements HasLabel, HasColor, HasIcon
{

    case WAITING = 'waiting';
    case APPROVED = 'approved';
    case DENIED = 'denied';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::WAITING => 'Beklemede',
            self::APPROVED => 'Onaylandı',
            self::DENIED => 'Reddedildi',
        };
    }


    public function getColor(): string | array | null
    {
        return match ($this) {
            self::WAITING => 'warning',
            self::APPROVED => 'success',
            self::DENIED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::WAITING => 'heroicon-m-eye',
            self::APPROVED => 'heroicon-m-check-circle',
            self::DENIED => 'heroicon-m-x-mark',
        };
    }


}
