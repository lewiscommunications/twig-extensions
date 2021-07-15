<?php

namespace lewiscom\twigextensions\extensions;

use Craft;
use Twig\Extension\AbstractExtension;
use lewiscom\twigextensions\traits\TwigExtensionTrait;

class RegExpExtension extends AbstractExtension
{
    use TwigExtensionTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return Craft::t('twigextensions', 'RegExp Extension');
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            $this->addFunction('pregReplace'),
        ];
    }

    /**
     * Use regular expression to search and replace
     * @link http://php.net/manual/en/function.preg-replace.php
     *
     * @param $value
     * @param $pattern
     * @param string $replacement
     * @param int $limit
     * @return null|string|string[]
     */
    public function pregReplace($value, $pattern, $replacement = '', $limit = -1)
    {
        $this->assertNoEval($pattern);

        if (! isset($value)) {
            return null;
        }

        return preg_replace($pattern, $replacement, $value, $limit);
    }

    /**
     * Check that the regex doesn't use the eval modifier
     *
     * @param string $pattern
     * @throws \LogicException
     */
    protected function assertNoEval($pattern)
    {
        $pos = strrpos($pattern, $pattern[0]);
        $modifiers = substr($pattern, $pos + 1);

        if (strpos($modifiers, 'e') !== false) {
            throw new \Twig_Error_Runtime(
                Craft::t('twigextensions', 'Using the eval modifier for regular expressions is not allowed.')
            );
        }
    }

}
