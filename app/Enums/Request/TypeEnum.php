<?php

namespace App\Enums\Request;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TypeEnum : string implements HasLabel, HasColor
{

    case BAN = 'ban';
    case KICK = 'kick';
    case TIMEOUT = 'timeout';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BAN => 'Yasaklama',
            self::KICK => 'Atma',
            self::TIMEOUT => 'Zaman Aşımı',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::BAN => 'danger',
            self::KICK => 'warning',
            self::TIMEOUT => 'info',
        };
    }

}
