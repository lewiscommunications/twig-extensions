<?php

namespace lewiscom\twigextensions\extensions;

use Craft;
use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionsTrait;

class RelativeDateExtension extends AbstractExtension
{
    use TwigExtensionsTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return Craft::t('twigextensions', 'Relative Time Extension');
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return [
            $this->addFilter('relativeDate')
        ];
    }

    /**
     * @param $date
     * @return string
     */
    public function relativeDate($from, $to = false, $precision = 1, $suffix = 'ago'): string
    {
        if (! $to) {
            $to = new \DateTime(gmdate('Y-m-d H:i:s'));
        }

        $diff = (new \DateTime($from->format('Y-m-d H:i:s')))->diff($to);
        $parts = [];

        $map = [
            'y' => Craft::t('twigextensions', 'year'),
            'm' => Craft::t('twigextensions', 'month'),
            'd' => Craft::t('twigextensions', 'day'),
            'h' => Craft::t('twigextensions', 'hour'),
            'i' => Craft::t('twigextensions', 'minute'),
            's' => Craft::t('twigextensions', 'second'),
        ];

        $suffix = Craft::t('twigextensions', $suffix);

        foreach ($diff as $key => $value) {
            if (isset($map[$key]) && $value) {
                $parts[] = $value . ' ' . $map[$key] . ($value > 1 ? 's' : '');
            }
        }

        $precision = count($parts) < $precision ? 0 : count($parts) - $precision;

        $reversed = array_reverse($parts);

        return implode(
            ', ',
            array_reverse(array_slice($reversed, $precision))
        ) . ($suffix ? ' ' . $suffix : '');
    }
}
