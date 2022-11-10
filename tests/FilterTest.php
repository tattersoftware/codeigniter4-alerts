<?php

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Test\FilterTestTrait;
use Tatter\Alerts\Filters\AlertsFilter;
use Tests\Support\TestCase;

/**
 * @internal
 */
final class FilterTest extends TestCase
{
    use FilterTestTrait;

    private string $body = <<<'EOD'
        <html>
        <head>
        	<title>Test</title>
        </head>
        <body>
        	<aside>{alerts}</aside>
        	<h1>Hello</h1>
        </body>
        </html>
        EOD;

    protected function setUp(): void
    {
        parent::setUp();

        $this->response->setBody($this->body);
        $this->response->setHeader('Content-Type', 'text/html');
    }

    public function testGather()
    {
        $expected = [
            ['primary', self::MESSAGE],
            ['secondary', self::MESSAGE],
            ['info', self::MESSAGE],
        ];

        session()->set('primary', self::MESSAGE);
        session()->set('secondary', [self::MESSAGE]);
        alert('info', self::MESSAGE);

        $result = AlertsFilter::gather($this->alerts);

        $this->assertSame($expected, $result);
    }

    public function testFilter()
    {
        config('Alerts')->template = 'Tatter\Alerts\Views\Bootstrap4';

        $expected = <<<'EOD'
            <html>
            <head>
            	<title>Test</title>
            </head>
            <body>
            	<aside>
            	<div role="alert" class="alert alert-success alert-dismissible fade show">
            		Congratulations!
            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            			<span aria-hidden="true">&times;</span>
            		</button>
            	</div>
            </aside>
            	<h1>Hello</h1>
            </body>
            </html>
            EOD;

        alert('success', 'Congratulations!');

        $caller = $this->getFilterCaller(AlertsFilter::class, 'after');
        $result = $caller();

        $this->assertInstanceOf(ResponseInterface::class, $result);
        $this->assertSame($expected, $result->getBody());
    }

    public function testNoAlerts()
    {
        $expected = <<<'EOD'
            <html>
            <head>
            	<title>Test</title>
            </head>
            <body>
            	<aside></aside>
            	<h1>Hello</h1>
            </body>
            </html>
            EOD;

        $caller = $this->getFilterCaller(AlertsFilter::class, 'after');
        $result = $caller();

        $this->assertInstanceOf(ResponseInterface::class, $result);
        $this->assertSame($expected, $result->getBody());
    }

    public function testUsesConfigTemplate()
    {
        $this->alerts->template = 'Tatter\Alerts\Views\Vanilla';

        alert('success', 'Congratulations!');

        $caller = $this->getFilterCaller(AlertsFilter::class, 'after');
        $result = $caller();

        $this->assertStringContainsString('dialog', $result->getBody());
    }

    public function testEmptyBody()
    {
        $this->response->setBody('');
        $caller = $this->getFilterCaller(AlertsFilter::class, 'after');

        $this->assertNull($caller());
    }

    public function testRedirect()
    {
        $this->response = redirect('');
        $caller         = $this->getFilterCaller(AlertsFilter::class, 'after');

        $this->assertNull($caller());
    }

    public function testWrongContentType()
    {
        $this->response->setHeader('Content-Type', 'application/json');
        $caller = $this->getFilterCaller(AlertsFilter::class, 'after');

        $this->assertNull($caller());
    }
}
