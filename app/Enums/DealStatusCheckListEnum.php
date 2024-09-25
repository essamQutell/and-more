<?php

namespace App\Enums;

enum DealStatusCheckListEnum : int
{
    case open = 1;
    case closed = 2;

    public function label(): string
    {
        return match ($this) {
            self::open => __('application.open'),
            self::closed => __('application.closed'),
        };
    }
}
