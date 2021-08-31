<?php

/**
 * This file is part of Tatter Alerts.
 *
 * (c) 2021 Tatter Software
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
