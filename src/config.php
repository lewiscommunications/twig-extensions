<?php

/**
 * Twigextensions config.php
 *
 * This file exists only as a template for the Presto settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'twigextensions.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

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
        lewiscom\twigextensions\extensions\RegExpExtension::class,
    ]
];