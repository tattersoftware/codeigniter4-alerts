<?php

/**
 * This file is part of Tatter Alerts.
 *
 * (c) 2021 Tatter Software
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use CodeIgniter\Test\CIUnitTestCase;
use Tatter\Alerts\Alerts;

/**
 * @internal
 */
final class ServiceTest extends CIUnitTestCase
{
    public function testServiceReturnsLibrary()
    {
        $result = service('alerts');

        $this->assertInstanceOf(Alerts::class, $result);
    }
}
