<?php namespace Tatter\Alerts\Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\View\RendererInterface;

class Services extends BaseService
{
    public static function alerts(BaseConfig $config = null, RendererInterface $view = null, bool $getShared = true)
    {
		if ($getShared):
			return static::getSharedInstance('alerts', $config, $view);
		endif;

		// If no config was injected then load one
		// Prioritizes app/Config if found
		if (empty($config))
			$config = config('Alerts');

		return new \Tatter\Alerts\Alerts($config, $view);
	}
}
