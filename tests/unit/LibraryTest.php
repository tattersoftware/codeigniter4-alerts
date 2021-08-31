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
final class LibraryTest extends AlertsTestCase
{
    public function testAdd()
    {
        $expected = [
            [
                'class' => 'fruit',
                'text'  => 'banana',
            ],
            [
                'class' => 'candy',
                'text'  => 'snickers',
            ],
        ];

        service('alerts')->add('fruit', 'banana');
        service('alerts')->add('candy', 'snickers');

        $this->assertSame($expected, session('alerts-queue'));
    }

    public function testCss()
    {
        $expected = view('Tatter\Alerts\Views\css', ['prefix' => 'alerts-']);
        $result   = service('alerts')->css();

        $this->assertSame($expected, $result);
    }
}
