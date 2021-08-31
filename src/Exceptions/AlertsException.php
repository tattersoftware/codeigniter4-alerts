<?php

namespace Tatter\Alerts\Exceptions;

use CodeIgniter\Exceptions\ExceptionInterface;
use CodeIgniter\Exceptions\FrameworkException;

class AlertsException extends FrameworkException implements ExceptionInterface
{
    public static function forInvalidTemplate(string $template = null)
    {
        return new static(lang('Alerts.invalidTemplate', [$template]));
    }

    public static function forMissingTemplateView(string $template = null)
    {
        return new static(lang('Alerts.missingTemplateView', [$template]));
    }
}
