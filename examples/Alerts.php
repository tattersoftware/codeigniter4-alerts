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
     */
    public string $template = 'Tatter\Alerts\Views\Bootstrap4';

    /**
     * Mapping of Session keys to their CSS classes.
     * Note: Some templates may add prefixes to the class,
     * like Bootstrap "alert-{$class}".
     *
     * @var array<string,string>
     */
    public array $classes = [
        // Bootstrap classes
        'primary'   => 'primary',
        'secondary' => 'secondary',
        'success'   => 'success',
        'danger'    => 'danger',
        'warning'   => 'warning',
        'info'      => 'info',

        // Additional log levels
        'message'   => 'primary',
        'notice'    => 'secondary',
        'error'     => 'danger',
        'critical'  => 'danger',
        'emergency' => 'danger',
        'alert'     => 'warning',
        'debug'     => 'info',

        // Common framework keys
        'messages' => 'primary',
        'errors'   => 'danger',
    ];
}
