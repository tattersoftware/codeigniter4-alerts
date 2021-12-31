<?php

use CodeIgniter\CodingStandard\CodeIgniter4;
use Nexus\CsConfig\Factory;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->files()
    ->in(__DIR__)
    ->exclude('build')
    ->append([__FILE__]);

// Remove overrides for incremental changes
$overrides = [
	'array_indentation' => false,
	'braces'            => false,
	'indentation_type'  => false,
];

$options = [
    'finder'    => $finder,
    'cacheFile' => 'build/.php-cs-fixer.cache',
];

return Factory::create(new CodeIgniter4(), $overrides, $options)->forProjects();

/* Reenable For libraries after incremental changes are applied
return Factory::create(new CodeIgniter4(), $overrides, $options)->forLibrary(
    'Tatter ________',
    'Tatter Software',
    '',
    2021
);
 */
