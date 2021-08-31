<?php

namespace Tatter\Alerts\Config;

use CodeIgniter\Config\BaseConfig;

class Alerts extends BaseConfig
{
	// prefix for SESSION variables and HTML classes, to prevent collision
	public $prefix = 'alerts-';

	// Template to use for HTML output
	public $template = 'Tatter\\Alerts\\Views\\bootstrap';

	// Whether to check session flashdata for common alert keys
	public $getflash = true;
}
