<?php

use Tests\Support\TestCase;

/**
 * @internal
 */
final class HelperTest extends TestCase
{
    public function testInvalidKeyThrows()
    {
        $this->expectException('UnexpectedValueException');
        $this->expectExceptionMessage('banana is not a configured alert key.');

        alert('banana', self::MESSAGE);
    }

    public function testSetsString()
    {
        alert('success', self::MESSAGE);

        $this->assertTrue(session()->has('success'));
        $this->assertSame([self::MESSAGE], session('success'));
    }

    public function testSetsArray()
    {
        alert('success', [self::MESSAGE]);

        $this->assertTrue(session()->has('success'));
        $this->assertSame([self::MESSAGE], session('success'));
    }

    public function testMergesString()
    {
        $content = 'This is not a test.';
        session()->set('success', $content);

        alert('success', self::MESSAGE);

        $this->assertSame([$content, self::MESSAGE], session('success'));
    }

    public function testMergesArray()
    {
        $content = 'This is not a test.';
        session()->set('success', [$content]);

        alert('success', self::MESSAGE);

        $this->assertSame([$content, self::MESSAGE], session('success'));
    }

    public function testCollision()
    {
        session()->set('success', 42);

        $this->expectException('RuntimeException');
        $this->expectExceptionMessage('Alerts has collided with a non-alert Session key: success');

        alert('success', self::MESSAGE);
    }
}
