<?php

namespace modules\twigextensionsmodule\twigextensions;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class GlobalVariablesExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @return array
     */
    public function getGlobals()
    {
        return [
            'conf' => Craft::$app->config->getGeneral()
        ];
    }
}
