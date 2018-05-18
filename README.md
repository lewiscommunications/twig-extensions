# TwigExtensions module for Craft CMS 3.x

This module adds some extra functionality to Twig.

## Requirements

This module requires Craft CMS 3.0.0-RC1 or later.

## Installation

To install the module, follow these instructions.

First, you'll need to add the contents of the `app.php` file to your `config/app.php` (or just copy it there if it does not exist). This ensures that your module will get loaded for each request. The file might look something like this:
```
return [
    'modules' => [
        'twig-extensions-module' => [
            'class' => \modules\twigextensionsmodule\TwigExtensionsModule::class,
        ],
    ],
    'bootstrap' => ['twig-extensions-module'],
];
```
You'll also need to make sure that you add the following to your project's `composer.json` file so that Composer can find your module:

    "autoload": {
        "psr-4": {
          "modules\\twigextensionsmodule\\": "modules/twigextensionsmodule/src/"
        }
    },

After you have added this, you will need to do:

    composer dump-autoload

 …from the project’s root directory, to rebuild the Composer autoload map. This will happen automatically any time you do a `composer install` or `composer update` as well.

 **Note:** The dump and die extension requires the [larapack/dd](https://github.com/larapack/dd) package

### CaseExtension

Includes some helpers to convert to various casing.

**Available Filters**

`camelCase`

Converts a string to camel case.

**Usage**

```twig
{{ 'camel-case-this-string'|camelCase }}
```

```
camelCaseThisString
```

`studlyCase`

Converts a string to studly case.

**Usage**

```twig
{{ 'studly-case-this-string'|studlyCase }}
```

```
CamelCaseThisString
```

### DumpDieExtension

Adds dump and dump and die functions to twig.

**Available Functions**

```twig
{{ d(variable) }}
```

Dumps a variable

```twig
{{ dd(variable) }}
```

Dumps a variable and stops further execution.

### GlobalVariablesExtension

Add global variables to twig.

**Available Variables**

`conf`

Returns `Craft::$app->config->getGeneral();`

### RelativeDateExtension

Converts a date object into a human readable relative date.

**Available Filters**

`relativeDate`

Usage

```twig
Created: {{ entry.createdAt|relativeDate }}
```

```html
Created: 1 hour ago
```

Brought to you by [Lewis Communications](https://www.lewiscommunications.com)
