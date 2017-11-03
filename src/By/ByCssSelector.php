<?php

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
    public function __construct($selector)
    {
        $converter = new CssSelectorConverter();
        $this->xPath = $converter->toXPath($selector, 'descendant::');
    }

    /**
     * @param \DOMElement[] $elements
     *
     * @return \DOMElement[]
     */
    public function findElements(array $elements)
    {
        return By::xPath($this->xPath)->findElements($elements);
    }
}
