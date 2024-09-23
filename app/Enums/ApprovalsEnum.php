<?php

namespace App\Enums;

enum ApprovalsEnum: int
{
    case completed = 1;
    case pending = 2;
    case update = 3;


    public function label(): string
    {
        return match ($this) {
            self::completed => __('application.completed'),
            self::pending => __('application.pending'),
            self::update => __('application.update'),
        };
    }
}
