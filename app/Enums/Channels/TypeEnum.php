<?php

namespace App\Enums\Channels;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use function Laravel\Prompts\select;

enum TypeEnum : int implements HasLabel
{

    case GUILD_TEXT = 0;
    case GUILD_VOICE = 2;
//    case GUILD_ANNOUNCEMENT = 5;
//    case GUILD_STAGE_VOICE = 13;
//    case GUILD_FORUM = 15;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::GUILD_TEXT => 'Yazılı',
            self::GUILD_VOICE => 'Sesli',
//            self::GUILD_ANNOUNCEMENT => 'Duyuru',
//            self::GUILD_STAGE_VOICE => 'Konferans',
//            self::GUILD_FORUM => 'Forum',
        };
    }
    public static function getName($value): string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->name;
            }
        }

        throw new \RuntimeException('Unknown enum value: ' . $value);
    }
    public static function getLabelNew($value): string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->getLabel();
            }
        }

        throw new \RuntimeException('Unknown enum value: ' . $value);
    }

}
