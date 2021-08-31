<?php

/*
 *
 * This file contains the optional wrapper helper functions to make calling the library easier.
 * Recommended usage:
 *	1. Load the helper with `helper("alerts")`
 *	2. Use `alert($class, $text) to add a new user alert
 *
 */

if (! function_exists('alert'))
{
	// add a new alert to the queue
	function alert(string $class, string $text) {
		$alerts = service('alerts');
		$alerts->add($class, $text);
	}
}
