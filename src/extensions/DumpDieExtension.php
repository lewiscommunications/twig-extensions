<?php

namespace lewiscom\twigextensions\extensions;

use Craft;
use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionsTrait;

class DumpDieExtension extends AbstractExtension
{
    use TwigExtensionsTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return Craft::t('twigextensions', 'Dump and Die Extension');
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            $this->addFunction('d'),
            $this->addFunction('dd')
        ];
    }

    /**
     * Dump
     */
    public function d()
    {
        call_user_func_array('dump', func_get_args());
    }

    /**
     * Dump and die
     */
    public function dd()
    {
        call_user_func_array('dump', func_get_args());
        die();
    }
}
