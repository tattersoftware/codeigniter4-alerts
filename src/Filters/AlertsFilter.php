<?php

namespace Tatter\Alerts\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Tatter\Alerts\Config\Alerts as AlertsConfig;

/**
 * Alerts Filter
 *
 * Injects alerts into the response body HTML
 * based on the configured classes.
 */
class AlertsFilter implements FilterInterface
{
    /**
     * Gathers alerts from Session based on the $config
     *
     * @return array<string[]>
     */
    public static function gather(AlertsConfig $config): array
    {
        // Gather alerts from the Session
        $session = service('session');
        $alerts  = [];

        foreach ($config->classes as $key => $class) {
            $content = session($key);

            // Unpack arrays looking for strings
            if (is_array($content)) {
                foreach ($content as $value) {
                    if (is_string($value)) {
                        $alerts[] = [$class, $value];
                    }
                }
            } elseif (is_string($content)) {
                $alerts[] = [$class, $content];
            }
        }

        return $alerts;
    }

    /**
     * Adds alerts from Session to the response.
     *
     * @param mixed|null $arguments Not implemented
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): ?ResponseInterface
    {
        // Ignore irrelevent responses
        if ($response instanceof RedirectResponse || empty($response->getBody())) {
            return null;
        }

        // Check CLI separately for coverage
        if (is_cli() && ENVIRONMENT !== 'testing') {
            return null; // @codeCoverageIgnore
        }

        // Only run on HTML content
        if (strpos($response->getHeaderLine('Content-Type'), 'html') === false) {
            return null;
        }

        $config = config('Alerts');

        // Gather the alerts
        $alerts = self::gather($config);
        $html   = $alerts === []
            ? ''
            : view($config->template, ['alerts' => $alerts]);

        // Replace the token with the new HTMl content
        $body = str_replace('{alerts}', $html, $response->getBody());

        // Use the new body and return the updated Response
        return $response->setBody($body);
    }

    /**
     * @codeCoverageIgnore
     *
     * @param mixed|null $arguments
     */
    public function before(RequestInterface $request, $arguments = null)
    {
    }
}
