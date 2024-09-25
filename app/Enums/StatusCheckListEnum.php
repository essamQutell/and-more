<?php

namespace App\Enums;

enum StatusCheckListEnum: int
{
    case not_started = 1;
    case complete = 2;
    case ontrack = 3;
    case critical = 4;
    case  delay = 5;

    public function label(): string
    {
        return match ($this) {
            self::not_started => __('application.not_started'),
            self::complete => __('application.complete'),
            self::ontrack => __('application.ontrack'),
            self::critical => __('application.critical'),
            self::delay => __('application.delay'),
        };
    }
}
