<?php

namespace App\Enums;

enum StatusEnum : int
{
    case status = 1;
    case deal = 2;


    public function label(): string
    {
        return match ($this) {
            self::status => __('application.status'),
            self::deal => __('application.deal'),
        };
    }
}
