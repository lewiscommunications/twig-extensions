<?php

namespace lewiscom\twigextensions\extensions;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class GlobalVariablesExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @return array
     */
    public function getGlobals():array
    {
        return [
            'conf' => Craft::$app->config->getGeneral()
        ];
    }
}
