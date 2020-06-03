<?php namespace Tatter\Alerts\Config;

use CodeIgniter\View\RendererInterface;

class Services extends \Config\Services
{
    public static function alerts(BaseConfig $config = null, RendererInterface $view = null, bool $getShared = true)
    {
		if ($getShared)
		{
			return static::getSharedInstance('alerts', $config, $view);
		}

		// If no config was injected then load one
		// Prioritizes app/Config if found
		if (empty($config))
		{
			$config = config('Alerts');
		}

		return new \Tatter\Alerts\Alerts($config, $view);
	}
}
