<?php namespace Config;

/***
*
* This file contains example values to change the default library behavior.
* Recommended usage:
*	1. Copy the file to app/Config/Alerts.php
*	2. Set any override variables
*	3. Remove any lines to fallback to library defaults
*
***/

class Alerts extends \Tatter\Alerts\Config\Alerts
{
	// prefix for SESSION variables and HTML classes, to prevent collision
	public $prefix = "alerts-";	

/*
	Template to use for HTML output
	There must be a corresponding view file for the path/namespace provided
	Native support for:
		basic - a minimalist layout internal to this library
		bootstrap (default) - [https://getbootstrap.com/docs/4.0/components/alerts/#dismissing]
		foundation - [https://foundation.zurb.com/sites/docs/callout.html#making-closable]
*/
	public $template = "Tatter\Alerts\Views\bootstrap";
}
