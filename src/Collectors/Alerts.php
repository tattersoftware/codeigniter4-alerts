<?php

namespace Tatter\Alerts\Collectors;

use CodeIgniter\Debug\Toolbar\Collectors\BaseCollector;
use Tatter\Alerts\Filters\AlertsFilter;

class Alerts extends BaseCollector
{
    /**
     * Whether this collector has data that can
     * be displayed in the Timeline.
     *
     * @var bool
     */
    protected $hasTimeline = false;

    /**
     * Whether this collector needs to display
     * content in a tab or not.
     *
     * @var bool
     */
    protected $hasTabContent = true;

    /**
     * Whether this collector has data that
     * should be shown in the Vars tab.
     *
     * @var bool
     */
    protected $hasVarData = false;

    /**
     * The 'title' of this Collector.
     * Used to name things in the toolbar HTML.
     *
     * @var string
     */
    protected $title = 'Alerts';

    /**
     * Store of alerts.
     *
     * @var array<string[]>
     */
    protected array $alerts;

    //--------------------------------------------------------------------

    /**
     * Preloads alerts so they are only gathered once.
     */
    public function __construct()
    {
        $this->alerts = AlertsFilter::gather(config('Alerts'));
    }

    //--------------------------------------------------------------------

    /**
     * Returns the data of this collector to be formatted in the toolbar
     */
    public function display(): string
    {
        $html = '';

        foreach ($this->alerts as $alert) {
            [$class, $content] = $alert;

            $html .= '<p><strong>' . ucfirst($class) . '</strong>: ' . esc($content) . '</p>' . PHP_EOL;
        }

        return $html;
    }

    //--------------------------------------------------------------------

    /**
     * Gets the "badge" value for the button.
     */
    public function getBadgeValue(): int
    {
        return count($this->alerts);
    }

    //--------------------------------------------------------------------

    /**
     * Display the icon.
     *
     * Icon from https://icons8.com - 1em package
     * https://icons8.com/icon/pack/data/p1em
     */
    public function icon(): string
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABmJLR0QA/wD/AP+gvaeTAAAAjklEQVQ4ja2TwQmAMAxF3ySKDqLbeCjqxKKOoBPowQSlJNKK/xJK819C0oKvAOwSs9UBK9ACEzB+MVdyLnIgsVmVBLHMRyrEq3xEZxMSgBkoDXAMQPJmHtvZgcZqywEg+dtvHcA9g9qpqNIZDNZl6hZM8xOy4L+DV7MHyTKreq5BNRL7HLMqcK3q029M1gn4Ri2RhwmVWQAAAABJRU5ErkJggg==';
    }
}
