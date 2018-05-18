<?php

namespace modules\twigextensionsmodule\twigextensions;

use Twig\Extension\AbstractExtension;
use modules\twigextensionsmodule\traits\TwigExtensionsTrait;

class CaseExtension extends AbstractExtension
{
    use TwigExtensionsTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Case';
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return [
            $this->addFilter('camelCase'),
            $this->addFilter('studlyCase')
        ];
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function studlyCase(string $string)
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $string)));
    }

    /**
     * @param string $string
     * @return string
     */
    public function camelCase(string $string)
    {
        return lcfirst($this->studlyCase($string));
    }
}
