<?php

/**
 * This file is part of Tatter Alerts.
 *
 * (c) 2021 Tatter Software
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

if (! function_exists('alert')) {
    // add a new alert to the queue
    function alert(string $class, string $text)
    {
        $alerts = service('alerts');
        $alerts->add($class, $text);
    }
}
