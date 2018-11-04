<?php

namespace lewiscom\twigextensions\extensions;

use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionsTrait;

class RelativeDateExtension extends AbstractExtension
{
    use TwigExtensionsTrait;

    private $hour;
    private $day;
    private $month;
    private $year;

    /**
     * RelativeDateExtension constructor.
     */
    public function __construct()
    {
        $this->hour = 3600;
        $this->day = $this->hour * 24;
        $this->month = $this->day * 30;
        $this->year = $this->day * 365;

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Relative time';
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
     * @param $time
     * @return string
     */
    public function relativeDate($time):string
    {
        $diff = time() - $time->format('U');

        if ($diff < $this->day) {
            return $this->hours($diff);
        } else if ($diff < $this->month) {
            return $this->days($diff);
        } else if ($diff < $this->year) {
            return $this->months($diff);
        }

        return $this->year($diff);
    }

    /**
     * @param int $diff
     * @return string
     */
    private function hours(int $diff):string
    {
        $hours = floor($diff / $this->hour);

        if ($hours < 1) {
            return 'Less than 1 hour';
        } else if ($hours == 1) {
            return '1 hour';
        }

        return $hours . ' hours';
    }

    /**
     * @param int $diff
     * @return string
     */
    private function days(int $diff):string
    {
        $days = floor($diff / $this->day);

        return $days . $days > 1 ? 's' : '';
    }

    private function months(int $diff)
    {
        $days = floor($diff / $this->day);

        if ($days >= 30 && $days < 60) {
            return 'About 1 month';
        }

        return floor($days / 30) . ' months';
    }

    private function year(int $diff)
    {
        $years = floor($diff / $this->year);

        return 'Over ' . $years . ' year' . $years > 1 ? 's' : '';
    }
}
