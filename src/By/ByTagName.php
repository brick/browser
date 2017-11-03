<?php

declare(strict_types=1);

namespace Brick\Browser\By;

use Brick\Browser\By;

/**
 * Locates elements by tag name.
 */
class ByTagName extends By
{
    /**
     * @var string
     */
    private $xPath;

    /**
     * @param string $tagName
     */
    public function __construct(string $tagName)
    {
        $this->xPath = 'descendant::' . $tagName;
    }

    /**
     * {@inheritdoc}
     */
    public function findElements(array $elements) : array
    {
       return By::xPath($this->xPath)->findElements($elements);
    }
}
