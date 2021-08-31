<?php

/**
 * This file is part of Tatter Alerts.
 *
 * (c) 2021 Tatter Software
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tatter\Alerts\Config;

use CodeIgniter\View\RendererInterface;
use Config\Services as BaseServices;
use Tatter\Alerts\Alerts;
use Tatter\Alerts\Config\Alerts as AlertsConfig;

class Services extends BaseServices
{
    public static function alerts(AlertsConfig $config = null, RendererInterface $view = null, bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('alerts', $config, $view);
        }

        $config = $config ?? config('Alerts');

        return new Alerts($config, $view);
    }
}
