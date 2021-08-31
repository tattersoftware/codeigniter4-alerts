<?php

/**
 * This file is part of Tatter Alerts.
 *
 * (c) 2021 Tatter Software
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Tatter\Alerts\Alerts;
use Tests\Support\AlertsTestCase;

/**
 * @internal
 */
final class ServiceTest extends AlertsTestCase
{
    public function testServiceReturnsLibrary()
    {
        $result = service('alerts');

        $this->assertInstanceOf(Alerts::class, $result);
    }
}
