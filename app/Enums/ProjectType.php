<?php

namespace App\Enums;

enum ProjectType : int
{
    case government = 1;
    case nonGovernment = 2;

    public function label(): string
    {
        return match ($this) {
            self::government => __('application.government'),
            self::nonGovernment => __('application.non_government'),
        };
    }
}
