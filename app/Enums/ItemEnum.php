<?php

namespace App\Enums;

enum ItemEnum: int
{
    case purchases = 1;
    case assets = 2;

    public function label(): string
    {
        return match ($this) {
            self::purchases => __('application.purchases'),
            self::assets => __('application.assets'),
        };
    }


}
