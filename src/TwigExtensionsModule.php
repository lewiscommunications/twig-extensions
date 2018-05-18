<?php

namespace modules\twigextensionsmodule;

use Craft;
use craft\i18n\PhpMessageSource;
use modules\twigextensionsmodule\twigextensions\CaseExtension;
use modules\twigextensionsmodule\twigextensions\DumpDieExtension;
use modules\twigextensionsmodule\twigextensions\GlobalVariablesExtension;
use modules\twigextensionsmodule\twigextensions\RelativeDateExtension;
use yii\base\Module;

class TwigExtensionsModule extends Module
{
    /**
     * @var TwigExtensionsModule
     */
    public static $instance;

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        Craft::setAlias('@modules/twigextensionsmodule', $this->getBasePath());
        $this->controllerNamespace = 'modules\twigextensionsmodule\controllers';

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

        // Set this as the global instance of this module class
        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    public function init()
    {
        parent::init();
        self::$instance = $this;

        $this->registerExtensions([
            CaseExtension::class,
            GlobalVariablesExtension::class,
            RelativeDateExtension::class
        ]);

        if (Craft::$app->env !== 'production') {
            $this->registerExtensions([
                DumpDieExtension::class,
            ]);
        }

        Craft::info(
            Craft::t(
                'twig-extensions-module',
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
}
