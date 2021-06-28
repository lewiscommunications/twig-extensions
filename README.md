# TwigExtensions module for Craft CMS 3.x

This module adds some extra functionality to Twig.

## Requirements

This module requires Craft CMS 3.0.0-RC1 or later.

## Installation

Require the composer package

```shell
composer require lewiscom/twigextensions
```

Add to the module to your `config/app.php`

```php
return [
    'modules' => [
        'twigextensions' => [
            'class' => lewiscom\twigextensions\TwigExtensionsModule::class
        ],
    ],
    'bootstrap' => [
        'twigextensions'
    ],
];
```

## Settings

If you need to disable certain extensions on a per environment basis, simply copy the configuration file below, name it `'twigextensions.php` place it in your `craft/config`  folder.  Here it will follow the same environemnt rules as other
craft configuration.

```php
<?php

return [
    // All environments
    '*' => [
        'disabled' => [
            lewiscom\twigextensions\extensions\PhoneNumberExtension::class,
        ],
    ],
    'production' => [
        'disabled' => [
            lewiscom\twigextensions\extensions\DumpDieExtension::class,
        ],
    ],
    'dev' => [
        'disabled' => [
            lewiscom\twigextensions\extensions\RegExpExtension::class,
        ],
    ],
];
```

## Extensions

### CaseExtension

Adds various case converting helpers

| Filter     | Input                                         | Output                   | Description                       |
| ---------- | --------------------------------------------- | ------------------------ | --------------------------------- |
| camelCase  | `{{ 'camel-case-this-string'\|camelCase }}`   | `camelCaseThisString`    | Camel cases a string              |
| StudlyCase | `{{ 'studly-case-this-string'\|studlyCase }}` | `StudlyCaseThisString`   | Studly, or Pascal, cases a string |
| kebab-case | `{{ 'studly-case-this-string'\|kebabCase }}`  | `kebab-case-this-string` | Kebab cases a string              |

### DumpDieExtension

Makes the [larapack/dd](https://github.com/larapack/dd) functions available in twig templates

| Function | Input                | Description                                       |
| -------- | -------------------- | ------------------------------------------------- |
| d        | `{{ d(variable) }}`  | Will dump the variable                            |
| dd       | `{{ dd(variable) }}` | Will dump the variable and stop further execution |

### GlobalVariablesExtension

Twig 2.x changes the way variables are scoped, this extension can help bring back some globals that you might not want to import into every template.  You may add as many global variables as you'd like, and set them to different values depending on environment

```php
<?php

return [
    '*' => [
        'globals' => [
            'conf' => Craft::$app->config->getGeneral()
        ],
    ],
];
```

### RelativeDateExtension

By default, it will convert a date object into a human readable relative date to the current date and time.

| Filter       | Input                   | Output        | Description                                                         |
| ------------ | ----------------------- | ------------- | ------------------------------------------------------------------- |
| relativeDate | `{{ entry.createdAt|relativeDate }}` | `2 hours ago` | Outputs a human readable relative date to the current date and time |

| Parameter   | Description                                                                        | Default | Required |
| ----------- | ---------------------------------------------------------------------------------- | :-----: | :------: |
| `to`        | A date to compare the initial date to                                              | `false` |          |
| `precision` | How precise the readout needs to be, increasing the number increases the precision | `1`     |          |
| `suffix`     | The suffix, set false to disable                                               | `'ago'`    |          |

### Examples

```twig
{{ entry.createdAt|relativeDate }}

2 hours ago
```

```twig
{{ entry.createdAt|relativeDate(false, 3) }}

4 months, 3 weeks, 4 days ago
```

```twig
{{ entry.createdAt|relativeDate(futureDate, 1, 'from now') }}

4 days from now
```

### RegExpExtension

Adds various regular expression functions

| Function    | Input                                     | Output | Description                                                                       |
| ----------- | ----------------------------------------- | ------ | --------------------------------------------------------------------------------- |
| pregReplace | `{{ pregReplace('test 123', '/\\D+/') }}` | `123`  | Uses PHPs `preg_replace` function to search and replace using regular expressions |

| Parameter     | Description                                                                     | Default | Required |
| ------------- | ------------------------------------------------------------------------------- | :-----: | :------: |
| `value`       | The string that will be searches                                                | -       | ✔        |
| `pattern`     | The regular expression pattern to be used. **Note** you must escape backslashes | -       | ✔        |
| `replacement` | What matches will be replaced with                                              | `''`    |          |
| `limit`       | The maximum number of matches                                                   | `-1`    |          |

Brought to you by [Lewis Communications](https://www.lewiscommunications.com)