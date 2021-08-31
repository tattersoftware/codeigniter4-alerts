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
