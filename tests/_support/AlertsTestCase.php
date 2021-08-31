<?php

/**
 * This file is part of Tatter Alerts.
 *
 * (c) 2021 Tatter Software
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

abstract class AlertsTestCase extends CIUnitTestCase
{
    protected function setUp(): void
    {
        Services::reset();

        parent::setUp();
    }
}
