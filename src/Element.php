<?php

declare(strict_types=1);

namespace Brick\Browser;

/**
 * A web element.
 */
class Element extends SearchContext implements Target
{
    /**
     * @var \DOMElement
     */
    private $domElement;

    /**
     * @param \DOMElement $element
     */
    public function __construct(\DOMElement $element)
    {
        $this->domElement = $element;
    }

    /**
     * Returns the wrapped DOM element.
     *
     * @return \DOMElement
     */
    public function getDomElement() : \DOMElement
    {
        return $this->domElement;
    }

    /**
     * @return string
     */
    public function getTagName() : string
    {
        return $this->domElement->tagName;
    }

    /**
     * Returns whether the tag name of the element matches the given tag name.
     *
     * @param string $tagName
     *
     * @return bool
     */
    public function is(string $tagName) : bool
    {
        return strtolower($this->domElement->tagName) === strtolower($tagName);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasAttribute(string $name) : bool
    {
        return $this->domElement->hasAttribute($name);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getAttribute(string $name) : string
    {
        return $this->domElement->getAttribute($name);
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function setAttribute(string $name, string $value) : void
    {
        $this->domElement->setAttribute($name, $value);
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function removeAttribute(string $name) : void
    {
        $this->domElement->removeAttribute($name);
    }

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->domElement->nodeValue;
    }

    /**
     * Returns the closest parent element matching the given tag name.
     *
     * @param string $tagName
     *
     * @return Element
     *
     * @throws Exception\NoSuchElementException
     */
    public function getParent(string $tagName) : Element
    {
        $tagName = strtolower($tagName);
        $element = $this->domElement;

        while ($element->parentNode) {
            $element = $element->parentNode;
            if (strtolower($element->tagName) === $tagName) {
                return new Element($element);
            }
        }

        throw new Exception\NoSuchElementException();
    }

    /**
     * Wraps the element in a TextControl to give it specific functionality.
     *
     * @return Wrapper\TextControl
     *
     * @throws Exception\UnexpectedElementException If the element is not a text input or a textarea.
     */
    public function toTextControl() : Wrapper\TextControl
    {
        return Wrapper\TextControl::create($this);
    }

    /**
     * Wraps the element in a ToggleButton to give it specific functionality.
     *
     * @return Wrapper\ToggleButton
     *
     * @throws Exception\UnexpectedElementException If the element is not a checkbox or a radiobutton.
     */
    public function toToggleButton() : Wrapper\ToggleButton
    {
        return Wrapper\ToggleButton::create($this);
    }

    /**
     * Wraps the element in a Select to give it specific functionality.
     *
     * @return Wrapper\Select
     *
     * @throws Exception\UnexpectedElementException If the element is not a select.
     */
    public function toSelect() : Wrapper\Select
    {
        return Wrapper\Select::create($this);
    }

    /**
     * Wraps the element in a FileInput to give it specific functionality.
     *
     * @return Wrapper\FileInput
     *
     * @throws Exception\UnexpectedElementException If the element is not a file input.
     */
    public function toFileInput() : Wrapper\FileInput
    {
        return Wrapper\FileInput::create($this);
    }

    /**
     * {@inheritdoc}
     */
    protected function getElements() : array
    {
        return [$this->domElement];
    }

    /**
     * {@inheritdoc}
     */
    public function getTargetElement(Browser $browser) : Element
    {
        return $this;
    }
}
