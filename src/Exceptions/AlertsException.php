<?php namespace Tatter\Alerts\Exceptions;

use CodeIgniter\Exceptions\ExceptionInterface;
use CodeIgniter\Exceptions\FrameworkException;

class AlertsException extends FrameworkException implements ExceptionInterface
{
	public static function forInvalidTemplate(string $template = null)
	{
		return new static("'{$template}' is not a valid Alerts template.");
	}
	public static function forMissingTemplateView(string $template = null)
	{
		return new static("Could not find template view file: '{$template}'.");
	}
}
