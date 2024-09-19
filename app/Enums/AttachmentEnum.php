<?php

namespace App\Enums;

enum AttachmentEnum: int
{
    case invoice = 1;
    case receipt = 2;
    case contract = 3;
    case quotation = 4;
    case betty_cash = 5;
    public function label(): string
    {
        return match ($this) {
            self::invoice => __('application.invoice'),
            self::receipt => __('application.receipt'),
            self::contract => __('application.contract'),
            self::quotation => __('application.quotation'),
            self::betty_cash => __('application.betty_cash'),
        };
    }


}
