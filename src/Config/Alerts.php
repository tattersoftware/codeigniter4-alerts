<?php

namespace Tatter\Alerts\Config;

use CodeIgniter\Config\BaseConfig;

class Alerts extends BaseConfig
{
    /**
     * Prefix for SESSION variables and HTML classes, to prevent collision.
     *
     * @var string
     */
    public $prefix = 'alerts-';

    /**
     * Template to use for HTML output.
     *
     * @var string
     */
    public $template = 'Tatter\\Alerts\\Views\\bootstrap';

    /**
     * Whether to check session flashdata for common alert keys.
     *
     * @var bool
     */
    public $getflash = true;
}
