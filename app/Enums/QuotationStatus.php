<?php

namespace App\Enums;

enum QuotationStatus : int
{
    case pending = 1;
    case approved = 2;
    case rejected = 3;

    public function label(): string
    {
        return match ($this) {
            self::pending => __('application.pending'),
            self::approved => __('application.approved'),
            self::rejected => __('application.rejected'),
        };
    }
}
