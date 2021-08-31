<?php

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
