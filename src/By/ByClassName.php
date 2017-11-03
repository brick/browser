<?php

declare(strict_types=1);

namespace Brick\Browser\By;

use Brick\Browser\By;

/**
 * Locates elements by class name.
 */
class ByClassName extends By
{
    /**
     * @var string
     */
    private $xPath;

    /**
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->xPath = sprintf(
            'descendant::*[contains(concat(" ", normalize-space(@class), " "), " %s ")]',
            $className
        );
    }

    /**
     * {@inheritdoc}
     */
    public function findElements(array $elements) : array
    {
        return By::xPath($this->xPath)->findElements($elements);
    }
}
