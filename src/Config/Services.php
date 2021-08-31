<?php

namespace Tatter\Alerts\Config;

use CodeIgniter\View\RendererInterface;
use Config\Services as BaseServices;
use Tatter\Alerts\Alerts;
use Tatter\Alerts\Config\Alerts as AlertsConfig;

class Services extends BaseServices
{
    public static function alerts(AlertsConfig $config = null, RendererInterface $view = null, bool $getShared = true)
    {
		if ($getShared)
		{
			return static::getSharedInstance('alerts', $config, $view);
		}

		$config = $config ?? config('Alerts');

		return new Alerts($config, $view);
	}
}
