<?php

declare(strict_types=1);

namespace Brick\Browser;

/**
 * Mechanism used to locate elements within a document.
 */
abstract class By implements Target
{
    /**
     * Returns a By which locates elements by id.
     *
     * @param string $id
     *
     * @return By\ById
     */
    public static function id(string $id) : By\ById
    {
        return new By\ById($id);
    }

    /**
     * Returns a By which locates elements by name.
     *
     * @param string $name
     *
     * @return By\ByName
     */
    public static function name(string $name) : By\ByName
    {
        return new By\ByName($name);
    }

    /**
     * Returns a By which locates elements by tag name.
     *
     * @param string $tagName
     *
     * @return By\ByTagName
     */
    public static function tagName(string $tagName) : By\ByTagName
    {
        return new By\ByTagName($tagName);
    }

    /**
     * Returns a By which locates elements by class name.
     *
     * @param string $className
     *
     * @return By\ByClassName
     */
    public static function className(string $className) : By\ByClassName
    {
        return new By\ByClassName($className);
    }

    /**
     * Returns a By which locates A elements by the exact text they display.
     *
     * @param string $text
     *
     * @return By\ByLinkText
     */
    public static function linkText(string $text) : By\ByLinkText
    {
        return new By\ByLinkText($text);
    }

    /**
     * Returns a By which locates A elements by the exact text they display.
     *
     * @param string $text
     *
     * @return By\ByPartialLinkText
     */
    public static function partialLinkText(string $text) : By\ByPartialLinkText
    {
        return new By\ByPartialLinkText($text);
    }

    /**
     * Returns a By which locates elements by CSS selector.
     *
     * @param string $selector
     *
     * @return By\ByCssSelector
     */
    public static function cssSelector(string $selector) : By\ByCssSelector
    {
        return new By\ByCssSelector($selector);
    }

    /**
     * Returns a By which locates elements by XPath.
     *
     * @param string $xPath
     *
     * @return By\ByXPath
     */
    public static function xPath(string $xPath) : By\ByXPath
    {
        return new By\ByXPath($xPath);
    }

    /**
     * @param By[] $bys
     *
     * @return By\ByChain
     */
    public static function chain(array $bys) : By\ByChain
    {
        return new By\ByChain($bys);
    }

    /**
     * Returns an array of elements matching this By locator appearing under any of the elements in the given list.
     *
     * This method is allowed to return duplicate elements; duplicates will be removed by the SearchContext.
     *
     * @param \DOMElement[] $elements
     *
     * @return \DOMElement[]
     */
    abstract public function findElements(array $elements) : array;

    /**
     * {@inheritdoc}
     */
    public function getTargetElement(Browser $browser) : Element
    {
        return $browser->find($this)->one();
    }
}
