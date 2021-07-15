<?php

namespace lewiscom\twigextensions\extensions;

use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionTrait;

class TemplateExistsExtension extends AbstractExtension
{
    use TwigExtensionTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return Craft::t('twigextensions', 'Template Exists');
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            $this->addFunction('templateExists'),
        ];
    }

    /**
     * @param string $string
     * @return bool
     */
    public function templateExists(string $string):bool
    {
        return file_exists(\Craft::getAlias('@templates', false) . '/' . $string);
    }
}
