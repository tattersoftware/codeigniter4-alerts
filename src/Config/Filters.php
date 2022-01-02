<?php

namespace Tatter\Alerts\Config;

use Config\Filters;
use Tatter\Alerts\Filters\AlertsFilter;

/**
 * @var Filters $filters
 */
$filters->aliases['alerts'] = AlertsFilter::class;
