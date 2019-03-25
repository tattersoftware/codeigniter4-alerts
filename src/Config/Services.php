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

		// prioritizes user config in app/Config if found
		if (empty($config)):
			if (class_exists('\Config\Alerts')):
				$config = new \Config\Alerts();
			else:
				$config = new \Tatter\Alerts\Config\Alerts();
			endif;
		endif;

		return new \Tatter\Alerts\Alerts($config, $view);
	}
}
