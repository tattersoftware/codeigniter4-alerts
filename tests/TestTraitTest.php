<?php

use CodeIgniter\Test\CIUnitTestCase;
use Tatter\Alerts\Test\AlertsTestTrait;
use Tests\Support\TestCase;

/**
 * @internal
 */
final class TestTraitTest extends CIUnitTestCase
{
    use AlertsTestTrait;

    public function testAlertExists()
    {
        alert('success', TestCase::MESSAGE);

        $this->assertAlertExists(TestCase::MESSAGE);
    }

    public function testAlertExistsWithClass()
    {
        alert('success', TestCase::MESSAGE);

        $this->assertAlertExists(TestCase::MESSAGE, 'success');
    }

    public function testAlertNotExists()
    {
        alert('success', TestCase::MESSAGE);

        $this->assertAlertDoesNotExist('This is not a test.');
    }

    public function testAlertNotExistsWithClass()
    {
        alert('success', TestCase::MESSAGE);

        $this->assertAlertDoesNotExist(TestCase::MESSAGE, 'danger');
    }
}
