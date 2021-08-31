<?php

/**
 * This file is part of Tatter Alerts.
 *
 * (c) 2021 Tatter Software
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Nexus\CsConfig\Factory;
use PhpCsFixer\Finder;
use Tatter\Tools\Standard;

$finder = Finder::create()
    ->files()
    ->in(__DIR__)
    ->exclude('build')
    ->append([__FILE__]);

// Remove overrides for incremental changes
$overrides = [];

$options = [
    'finder'    => $finder,
    'cacheFile' => 'build/.php-cs-fixer.cache',
];

return Factory::create(new Standard(), $overrides, $options)->forLibrary(
    'Tatter Alerts',
    'Tatter Software',
    '',
    2021
);

return Factory::create(new Standard(), $overrides, $options)->forProjects();
