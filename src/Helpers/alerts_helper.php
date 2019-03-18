<?php

/***
*
* This file contains optional helper functions to make calling the library easier.
* Recommended usage:
*	1. Load the helper with `helper("alerts")`
*	2. Use `alert($class, $text) to add a new user alert
*	3. Call `alertsCss()` in <head> for a basic CSS layout, or provide your own
*	4. Call `alertsDisplay()` wherever you want alerts (usually after main nav/banner)
*
***/

if (! function_exists('alert'))
{
	// add a new alert to the queue
	function alert(string $class, string $text) {
		$alerts = new Tatter\Libraries\Alerts();
		$alerts->add($class, $text);
	}
}

if (! function_exists('alertsCss'))
{
	// outputs pre-configured CSS as inline style sheet
	function alertsCss() {
		$alerts = new Tatter\Libraries\Alerts();
		$alerts->css();	
	}
}

if (! function_exists('alerts'))
{
	// outputs all queue alerts and clears the queue
	function alerts() {
		$alerts = new Tatter\Libraries\Alerts();
		$alerts->display();	
	}
}
