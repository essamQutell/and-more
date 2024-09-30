<?php

namespace App\Enums;

enum AdminSectionEnum: int
{
    case admins = 1;
    case roles = 2;
    case users = 3;
    case settings = 4;
    case projects = 5;
    case suppliers = 6;
    case quotations = 7;
    case services = 8;
    case statuses = 9;
    case categories = 10;
    case phases = 11;

    public function label(): string
    {
        return match ($this) {
            self::roles => __('application.roles'),
            self::admins => __('application.admins'),
            self::users => __('application.users'),
            self::settings => __('application.settings'),
            self::projects => __('application.projects'),
            self::suppliers => __('application.suppliers'),
            self::quotations => __('application.quotations'),
            self::services => __('application.services'),
            self::statuses => __('application.statuses'),
            self::categories => __('application.categories'),
            self::phases => __('application.phases'),
        };
    }
}
