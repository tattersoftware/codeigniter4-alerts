<?php

namespace Config;

/**
 * This file contains example values to change the default library behavior.
 * Recommended usage:
 *	1. Copy the file to app/Config/Alerts.php
 *	2. Set any override variables
 *	3. Remove any lines to fallback to library defaults
 */

use Tatter\Alerts\Config\Alerts as AlertsConfig;

class Alerts extends AlertsConfig
{
    /**
     * Template to use for HTML output.
     *
     * @var string
     */
    public $template = 'Tatter\Alerts\Views\Bootstrap4';

    /**
     * Mapping of Session keys to their CSS classes.
     * Note: Some templates may add prefixes to the class,
     * like Bootstrap "alert-{$class}".
     *
     * @var array<string,string>
     */
    public $classes = [
        'primary'   => 'primary',
        'message'   => 'primary',
        'secondary' => 'secondary',
        'notice'    => 'secondary',
        'success'   => 'success',
        'danger'    => 'danger',
        'error'     => 'danger',
        'errors'    => 'danger',
        'critical'  => 'danger',
        'emergency' => 'danger',
        'warning'   => 'warning',
        'alert'     => 'warning',
        'info'      => 'info',
        'debug'     => 'info',
    ];
}
