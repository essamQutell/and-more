<?php

namespace App\Enums;

enum DateEnum : int
{
    case event = 1;
    case setUp = 2;
    case dismantle = 3;


    public function label(): string
    {
        return match ($this) {
            self::event => __('application.event'),
            self::setUp => __('application.set_up'),
            self::dismantle => __('application.dismantle'),
        };
    }


}
