<?php

namespace Tatter\Alerts\Config;

use Tatter\Alerts\Collectors\Alerts;
use Tatter\Alerts\Filters\AlertsFilter;

class Registrar
{
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'alerts' => AlertsFilter::class,
            ],
        ];
    }

    public static function Toolbar(): array
    {
        return [
            'collectors' => [
                Alerts::class,
            ],
        ];
    }
}
