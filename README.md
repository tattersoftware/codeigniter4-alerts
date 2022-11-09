# Tatter\Alerts
Lightweight user alerts for CodeIgniter 4

[![](https://github.com/tattersoftware/codeigniter4-alerts/workflows/PHPUnit/badge.svg)](https://github.com/tattersoftware/codeigniter4-alerts/actions/workflows/test.yml)
[![](https://github.com/tattersoftware/codeigniter4-alerts/workflows/PHPStan/badge.svg)](https://github.com/tattersoftware/codeigniter4-alerts/actions/workflows/analyze.yml)
[![](https://github.com/tattersoftware/codeigniter4-alerts/workflows/Deptrac/badge.svg)](https://github.com/tattersoftware/codeigniter4-alerts/actions/workflows/inspect.yml)
[![Coverage Status](https://coveralls.io/repos/github/tattersoftware/codeigniter4-alerts/badge.svg?branch=develop)](https://coveralls.io/github/tattersoftware/codeigniter4-alerts?branch=develop)

![Screenshot](https://github.com/tattersoftware/codeigniter4-alerts/blob/master/img/screenshot2.png)

## Quick Start

1. Install with Composer: `> composer require tatter/alerts`
2. Enable the `alerts` filter in **app/Config/Filters.php**
3. Add the `{alerts}` token to your View Layouts
4. Load the helper: `helper('alerts');`
4. Set an alert with a class and message: `alert('success', 'You did it!')`

## Features

Provides integrated user alerts for CodeIgniter 4 with a variety of built-in templates
and custom template support.

## Installation

Install easily via Composer to take advantage of CodeIgniter 4's autoloading capabilities
and always be up-to-date:
```bash
composer require tatter/alerts
```

Or, install manually by downloading the source files and adding the directory to
`app/Config/Autoload.php`.

> Note: The default display template expects [Bootstrap](https://getbootstrap.com) (not included)

## Configuration (optional)

The library's default behavior can be changed using its config file. Copy
**examples/Alerts.php** to **app/Config/Alerts.php** and follow the instructions in the
comments. If no config file is found the library will use its defaults.

The Config file consists of two properties.

### Templates

The `$template` property sets the path to the View file which will be used to format your
alerts. The default template has HTML tags and classes designed for use with
[Bootstrap 5 Alerts](https://getbootstrap.com/docs/5.2/components/alerts/), but the library
includes additional templates for you to choose:
* `Tatter\Alerts\Views\Bootstrap4`: Compatible with the Bootstrap 4 CSS Framework
* `Tatter\Alerts\Views\Foundation`: Compatible with the Foundation CSS Framework
* `Tatter\Alerts\Views\Vanilla`: A framework-free implementation, with classes available for your own CSS styling

And of course you can add your own. The view file will be passed an array of tuples named
`$alerts`, with each tuple in the format `[string $class, string $content]`. Your view file
should unpack each tuple:
```php
foreach ($alerts as $alert) {
    [$class, $content] = $alert;
```
... then output the alert `$content` wrapped in some appropriate HTML tags with whatever
styling or classes you like based on `$class`.

> Note: This library *does not include* assets for Bootstrap or Foundation. Check out
> [Tatter\Frontend](https://github.com/tattersoftware/codeigniter4-frontend) for an integrated solution.

### Classes

The `$classes` property is a mapping of Session keys to their CSS classes. This lets you
control which Session keys are deemed "alerts" and how to designate them to your view
template. The default list is a generous guess at common keys used by the framework and
modules, with the addition of the Bootstrap alert classes, but in most cases you will want
to slim this down or replace it altogether with your own.

*See **Warnings** below for some caveats to consider when auto-populating Session keys into displayable content.*

## Filter

In order to use the `AlertsFilter` you must add apply it to your target routes. The filter
only applies when the token is present so it is safe to apply it globally in **app/Config/Filters.php**.
See [Controller Filters](https://codeigniter.com/user_guide/incoming/filters.html) for more info.

> Note: The alias is predefined for you as "alerts", and only the `after()` method is relevant.

## Token

The token is the following string: `{alerts}`. Place this in your View layout where you want
the alerts to appear. For example:
```php
<body>
    <aside>
    {alerts}
    </aside>
    <main class="wrapper">
    ...
```

## Usage

If installed correctly CodeIgniter 4 will detect and autoload the library, filter, helper,
and config. The filter will gather any alerts from the Session keys defined in your Config,
pass them through your View template for formatting, and place them into your Response body
wherever you have placed your token - you just need to set the alerts!

Alerts can be set directly in the Session, ideally as flashdata (so they are not repeated):
```php
session()->setFlashdata('success', 'Your account has been updated.');
```

Many times your alerts will be handled during redirect, so you can take advantage of
the framework's `RedirectResponse` class method `with()` to apply the flashdata directly:
```php
if (! $fruit = $this->getPost('fruit')) {
    return redirect()->back()->with('error', 'You must select a fruit!');
}
```

### Helper

This library also includes a helper function, which has the added benefit of merging values
and checking for collision. Initialize the helper to us the convenience wrapper function:
```php
helper(['alerts']);
alert('error', 'You must accept the terms of service to continue.');
```

The helper adds a few features (like collision detection and alert merging) but may throw
exceptions in some circumstances - read the **Collision** section below.

### Collector

There is a [Toolbar Collector](https://www.codeigniter.com/user_guide/testing/debugging.html#creating-custom-collectors)
bundled with this library to ease development and integration. It is enabled by default and
should appear in the development environment whenever the Toolbar is active.

## Warnings

The premise of this library is to take data from `$_SESSION` and display it to visitors of
your site. There are a few precautions mentioned here, but in general: use strong security
practices and good sense any time you are moving data between the backend and public views.

### Security

Ideally `$_SESSION` should not contain critical information like passwords or credit card
numbers. You should also not use distinguishable identifiers as Session keys, and this goes
for `Alerts` as well. Keep the keys you use basic, and consider pairing down the Config
file's to only those values your app and modules need.

For example, say you add a payment library to your project and some developer was using
the following code to test credit card submission and forgot to remove it:
```php
$_SESSION['debug'] = (string) $user->getCreditCard();
```

Since "debug" is a valid `Alerts` key this credit card number will now become a alert
displayed visually on the user's browser window! 

### Collision

Another concern is Session collision. Starting with an example this time:
```php
/** @var Notice $notice */
$notice = model(NoticeModel::class)->first();
session('notice', $notice);
...

// Later that same day...
alert('notice', 'Site statistics are currently being updated, expect longer load times.');
```

We have just tried to set an alert for a Session key that already exists and contains
something that is not another alert! There are a few ways that this can play out, but
ultimately this was a mistake and you should take care to avoid it.

To clarify the example:
1. `AlertsFilter` will quietly ignore Session data that is not a string or an array of strings, so there is no problem with `session('notice', $notice);`.
2. Using the Alerts Helper to set your alert includes the additional layer of collision protection, but will cause the `alert()` function to throw an exception.
3. Setting Session keys yourself is a fine solution, but you must handle checks for existing keys or risk overwriting data.
