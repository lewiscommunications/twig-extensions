<?php

namespace lewiscom\twigextensions;

use Craft;
use yii\base\Module;
use craft\i18n\PhpMessageSource;
use lewiscom\twigextensions\extensions\CaseExtension;
use lewiscom\twigextensions\extensions\TemplateExistsExtension;
use lewiscom\twigextensions\extensions\ClassExtension;
use lewiscom\twigextensions\extensions\StringExtension;
use lewiscom\twigextensions\extensions\DumpDieExtension;
use lewiscom\twigextensions\extensions\PhoneNumberExtension;
use lewiscom\twigextensions\extensions\RelativeDateExtension;
use lewiscom\twigextensions\extensions\GlobalVariablesExtension;
use lewiscom\twigextensions\extensions\RegExpExtension;

class TwigExtensionsModule extends Module
{
    /**
     * @var TwigExtensionsModule
     */
    public static $instance;

    /**
     * The available extensions
     *
     * @var array
     */
    public $extensions = [
        CaseExtension::class,
        PhoneNumberExtension::class,
        GlobalVariablesExtension::class,
        RelativeDateExtension::class,
        ClassExtension::class,
        TemplateExistsExtension::class,
        StringExtension::class,
        RegExpExtension::class,
        DumpDieExtension::class,
    ];

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        Craft::setAlias('@modules/twigextensionsmodule', $this->getBasePath());
        $this->controllerNamespace = 'lewiscom\twigextensions\controllers';

        // Set translation category
        $this->setI18n($id);

        // Set this as the global instance of this module class
        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    public function init()
    {
        parent::init();
        self::$instance = $this;

        $settings = Craft::$app->config->getConfigFromFile('twigextensions');

        $this->registerExtensions(
            array_diff($this->extensions, $settings['disabled'] ?? [])
        );

        Craft::info(
            Craft::t(
                'twigextensions',
                '{name} module loaded',
                ['name' => 'TwigExtensions']
            ),
            __METHOD__
        );
    }

    /**
     * Register twig extensions
     *
     * @param array $extensions
     */
    private function registerExtensions(array $extensions)
    {
        foreach ($extensions as $extension) {
            Craft::$app->view->registerTwigExtension(new $extension);
        }
    }

    /**
     * Set the internationalization category
     *
     * @param $id - module id
     */
    private function setI18n($id) {
        // Translation category
        $i18n = Craft::$app->getI18n();
        /** @noinspection UnSafeIsSetOverArrayInspection */
        if (! isset($i18n->translations[$id]) && ! isset($i18n->translations[$id.'*'])) {
            $i18n->translations[$id] = [
                'class' => PhpMessageSource::class,
                'sourceLanguage' => 'en-US',
                'basePath' => '@modules/twigextensionsmodule/translations',
                'forceTranslation' => true,
                'allowOverrides' => true,
            ];
        }
    }
}
