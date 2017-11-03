<?php

declare(strict_types=1);

namespace Brick\Browser\By;

use Brick\Browser\By;

use Symfony\Component\CssSelector\CssSelectorConverter;

/**
 * Locates elements by CSS selector.
 */
class ByCssSelector extends By
{
    /**
     * @var string
     */
    private $xPath;

    /**
     * @param string $selector
     */
    public function __construct(string $selector)
    {
        $converter = new CssSelectorConverter();
        $this->xPath = $converter->toXPath($selector, 'descendant::');
    }

    /**
     * {@inheritdoc}
     */
    public function findElements(array $elements) : array
    {
        return By::xPath($this->xPath)->findElements($elements);
    }
}
