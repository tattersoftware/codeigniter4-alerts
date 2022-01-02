<?php

namespace Tatter\Alerts\Config;

use CodeIgniter\Config\BaseConfig;

class Alerts extends BaseConfig
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
