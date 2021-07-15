<?php

namespace lewiscom\twigextensions\extensions;

use Craft;
use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionTrait;

class ClassExtension extends AbstractExtension
{
    use TwigExtensionTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return Craft::t('twigextensions', 'Class Extension');
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
            throw new \Twig_Error_Loader(
                Craft::t('twigextensions', 'Value passed to the getClass function must be of type object.')
            );
        }

        return (new \ReflectionClass($object))->getShortName();
    }
}
