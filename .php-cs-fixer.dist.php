<?php

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

/* Reenable after incremental changes are applied
return Factory::create(new Standard(), $overrides, $options)->forLibrary(
    'Tatter Alerts',
    'Tatter Software',
    '',
    2021
);
 */
return Factory::create(new Standard(), $overrides, $options)->forProjects();
