# Tatter\Alerts
Lightweight user alerts for CodeIgniter 4

[![](https://github.com/tattersoftware/codeigniter4-alerts/workflows/PHPUnit/badge.svg)](https://github.com/tattersoftware/codeigniter4-alerts/actions?query=workflow%3A%22PHPUnit)
[![](https://github.com/tattersoftware/codeigniter4-alerts/workflows/PHPStan/badge.svg)](https://github.com/tattersoftware/codeigniter4-alerts/actions?query=workflow%3A%22PHPStan)
[![Coverage Status](https://coveralls.io/repos/github/tattersoftware/codeigniter4-alerts/badge.svg?branch=develop)](https://coveralls.io/github/tattersoftware/codeigniter4-alerts?branch=develop)

![Screenshot](https://github.com/tattersoftware/codeigniter4-alerts/blob/master/img/screenshot2.png)

## Quick Start

1. Run: `> composer require tatter/alerts`
2. Load the helper: `helper('alerts');`
2. Set an alert: `alert('success', "You did it!")`
3. Add in head tag (optional): `<?= service('alerts')->css(); ?>`
4. Add after banner/menu: `<?= service('alerts')->display(); ?>`

## Features

Provides out-of-the-box user alerts for CodeIgniter 4

## Installation

Install easily via Composer to take advantage of CodeIgniter 4's autoloading capabilities
and always be up-to-date:
* `> composer require tatter/alerts`

Or, install manually by downloading the source files and adding the directory to
`app/Config/Autoload.php`.

Note: The default display template expects [Bootstrap4](https://getbootstrap.com) but is
easily changed.

## Configuration (optional)

The library's default behavior can be changed using its config file. Copy
**examples/Alerts.php** to **app/Config/Alerts.php** and follow the instructions in the
comments. If no config file is found the library will use its defaults.

## Usage

If installed correctly CodeIgniter 4 will detect and autoload the library, service, helper,
and config. Initialize the helper if you want the convenience wrapper function:
`helper('tatter\alerts');`

Then use the helper function `alert($class, $text)` to set an alert for the user's next
view. Use class methods `$alerts->css()` and `$alerts->display()` to retrieve the styling
and HTML for the alerts.

## Styles

By default alerts will be displayed with classes for Bootstrap (not included).
However, styles can be set to use other toolkits (or you may use your own) by changing
`$template` in the config file.
