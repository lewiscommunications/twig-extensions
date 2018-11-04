<?php

namespace lewiscom\twigextensions\extensions;

use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionsTrait;

class ClassExtension extends AbstractExtension
{
    use TwigExtensionsTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Class Extension';
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            $this->addFunction('getClass'),
        ];
    }

    /**
     * Get the class
     *
     * @param $object
     * @return string
     * @throws \ReflectionException
     * @throws \Twig_Error_Loader
     */
    public function getClass($object):string
    {
        if (! is_object($object)) {
            throw new \Twig_Error_Loader('Value passed to the getClass function must be of type object.');
        }

        return (new \ReflectionClass($object))->getShortName();
    }
}
