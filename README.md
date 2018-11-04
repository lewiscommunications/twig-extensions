# TwigExtensions module for Craft CMS 3.x

This module adds some extra functionality to Twig.

## Requirements

This module requires Craft CMS 3.0.0-RC1 or later.

## Extensions

### CaseExtension

Adds various case converting helpers

| Filter     | Input                                        | Output                   | Description                       |
| ---------- | -------------------------------------------- | ------------------------ | --------------------------------- |
| camelCase  | `{{ 'camel-case-this-string'camelCase }}`    | `camelCaseThisString`    | Camel cases a string              |
| StudlyCase | `{{ 'studly-case-this-string'|studlyCase }}` | `StudlyCaseThisString`   | Studly, or Pascal, cases a string |
| kebab-case | `{{ 'studly-case-this-string'|kebabCase }}`  | `kebab-case-this-string` | Kebab cases a string              |

### DumpDieExtension

Makes the [larapack/dd](https://github.com/larapack/dd) functions available in twig templates locally

| Function | Input                | Description                                       |
| -------- | -------------------- | ------------------------------------------------- |
| d        | `{{ d(variable) }}`  | Will dump the variable                            |
| dd       | `{{ dd(variable) }}` | Will dump the variable and stop further execution |

### GlobalVariablesExtension

Twig 2.x changes the way variables are scoped, this extension can help bring back some globals that you might not want to import into every template.

```php
/**
 * @return array
 */
public function getGlobals():array
{
    return [
        'conf' => Craft::$app->config->getGeneral()
    ];
}
```

### RelativeDateExtension

Converts a date object into a human readable relative date.

| Filter       | Input                   | Output      | Description                                                         |
| ------------ | ----------------------- | ----------- | ------------------------------------------------------------------- |
| relativeDate | `{{ entry.createdAt }}` | 2 hours ago | Outputs a human readable relative date to the current date and time |

Brought to you by [Lewis Communications](https://www.lewiscommunications.com)