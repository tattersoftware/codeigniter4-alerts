<?php

use Tatter\Alerts\Collectors\Alerts;
use Tests\Support\TestCase;

/**
 * @internal
 */
final class CollectorTest extends TestCase
{
    protected Alerts $collector;

    protected function setUp(): void
    {
        parent::setUp();

        alert('success', self::MESSAGE);
        alert('warning', 'This is not a test.');

        $this->collector = new Alerts();
    }

    public function testDisplay()
    {
        $expected = <<<'EOD'
            <p><strong>Success</strong>: This is just a test.</p>
            <p><strong>Warning</strong>: This is not a test.</p>

            EOD;

        $result = $this->collector->display();

        $this->assertSame($expected, $result);
    }

    public function testBadgeValue()
    {
        $result = $this->collector->getBadgeValue();

        $this->assertSame(2, $result);
    }

    public function testIcon()
    {
        $result = $this->collector->icon();

        $this->assertStringContainsString('data:image/png;base64', $result);
    }
}
