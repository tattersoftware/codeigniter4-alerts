<?php

namespace Tatter\Alerts\Test;

use Tatter\Alerts\Config\Alerts as AlertsConfig;
use Tatter\Alerts\Filters\AlertsFilter;

/**
 * Alerts Test Trait
 *
 * Provides convenience methods for testing the
 * presence, class, and content of alerts.
 */
trait AlertsTestTrait
{
    /**
     * @var AlertsConfig
     */
    protected $alerts;

    /**
     * Stores the Alerts Config to use during testing.
     */
    protected function setUpAlertsTestTrait(): void
    {
        // Create the config
        $this->alerts = config('Alerts');
        helper(['alerts']);
    }

    /**
     * Asserts that an alert was created with the given message,
     * and optionally the class.
     */
    protected function assertAlertExists(string $content, ?string $class = null): void
    {
        $type = $class === null ? '' : " of type {$class}";

        $this->assertGreaterThan(
            0,
            $this->matchAlerts($content, $class),
            "Failed asserting that an alert{$type} exists, with content: {$content}"
        );
    }

    /**
     * Asserts that an alert was created with the given message,
     * and optionally the class.
     */
    protected function assertAlertDoesNotExist(string $content, ?string $class = null): void
    {
        $type = $class === null ? '' : " of type {$class}";

        $this->assertSame(
            0,
            $this->matchAlerts($content, $class),
            "Failed asserting that an alert{$type} does not exist, with content: {$content}"
        );
    }

    /**
     * Matches alerts by content and optional class.
     */
    private function matchAlerts(string $content, ?string $class = null): int
    {
        $matched = 0;

        foreach (AlertsFilter::gather($this->alerts) as $alert) {
            [$myClass, $myContent] = $alert;

            if ($content === $myContent && ($class === null || $class === $myClass)) {
                $matched++;
            }
        }

        return $matched;
    }
}
