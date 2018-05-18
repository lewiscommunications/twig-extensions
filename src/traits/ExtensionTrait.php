<?php

namespace modules\twigextensionsmodule\traits;

trait TwigExtensionsTrait
{
    /**
     * @param string $name
     * @return \Twig_SimpleFilter
     */
    private function addFilter(string $name)
    {
        return new \Twig_SimpleFilter($name, [$this, $name]);
    }

    /**
     * @param $name
     * @return \Twig_SimpleFunction
     */
    private function addFunction($name)
    {
        return new \Twig_SimpleFunction($name, [$this, $name]);
    }
}
