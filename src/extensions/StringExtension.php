<?php

namespace lewiscom\twigextensions\extensions;

use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionsTrait;

class StringExtension extends AbstractExtension
{
    use TwigExtensionsTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return Craft::t('twigextensions', 'String Extension');
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return [
            $this->addFilter('truncate'),
        ];
    }

    /**
     * Cut of text if it's to long.
     *
     * @param string $value
     * @param int $length
     * @param string $replace
     * @return string
     */
    public function truncate($value, $length, $replace = '...'):string
    {
        if (! isset($value)) {
            return null;
        }

        return strlen($value) <= $length
            ? $value
            : substr($value, 0, $length - strlen($replace))
                . $replace;
    }
}
