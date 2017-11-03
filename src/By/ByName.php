<?php

declare(strict_types=1);

namespace Brick\Browser\By;

use Brick\Browser\By;

/**
 * Locates elements by name.
 */
class ByName extends By
{
    /**
     * @var string
     */
    private $xPath;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->xPath = sprintf('descendant::*[@name = "%s"]', $name);
    }

    /**
     * {@inheritdoc}
     */
    public function findElements(array $elements) : array
    {
        return By::xPath($this->xPath)->findElements($elements);
    }
}
