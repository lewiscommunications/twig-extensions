<?php

namespace lewiscom\twigextensions\extensions;

use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionsTrait;

class PhoneNumberExtension extends AbstractExtension
{
    use TwigExtensionsTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Phone Number';
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return [
            $this->addFilter('phone'),
        ];
    }

    /**
     * @param string $string
     * @return string
     */
    public function phone(string $string):string
    {
        return preg_replace('/[^\+\d+]/', '', $string);
    }
}
