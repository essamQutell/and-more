<?php

namespace App\Enums;

enum ProgressEnum: int
{
    case production = 1;
    case in_progress = 2;
    case update = 3;
    case complete = 4;
    case cancel = 5;
    case pending = 6;

    public function label(): string
    {
        return match ($this) {
            self::production => __('application.production'),
            self::in_progress => __('application.in_progress'),
            self::update => __('application.update'),
            self::complete => __('application.complete'),
            self::cancel => __('application.cancel'),
            self::pending => __('application.pending'),
        };
    }
}
