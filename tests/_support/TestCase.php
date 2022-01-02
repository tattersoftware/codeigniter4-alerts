<?php

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use Tatter\Alerts\Config\Alerts as AlertsConfig;

/**
 * @internal
 */
abstract class TestCase extends CIUnitTestCase
{
    public const MESSAGE = 'This is just a test.';

    /**
     * @var AlertsConfig
     */
    protected $alerts;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        helper(['alerts']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->alerts = config('Alerts');
    }
}
