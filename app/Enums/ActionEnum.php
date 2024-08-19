<?php

namespace App\Enums;

enum ActionEnum: int
{
    case create = 1;
    case read = 2;
    case update = 3;
    case delete = 4;
    case manage = 5;
    case send = 6;

    public function label(): string
    {
        return match ($this) {
            self::create => __('application.create'),
            self::read => __('application.read'),
            self::update => __('application.update'),
            self::delete => __('application.delete'),
            self::manage => __('application.manage'),
            self::send => __('application.send'),
        };
    }
}
