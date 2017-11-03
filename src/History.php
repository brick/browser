<?php

declare(strict_types=1);

namespace Brick\Browser;

use Brick\Http\Request;

/**
 * Stores the history of a Browser's requests.
 */
class History
{
    /**
     * @var \Brick\Http\Request[]
     */
    private $requests = [];

    /**
     * @var int
     */
    private $position = -1;

    /**
     * Clears the browser history.
     *
     * @return void
     */
    public function clear() : void
    {
        $this->requests = [];
        $this->position = -1;
    }

    /**
     * @return bool
     */
    public function isEmpty() : bool
    {
        return $this->position === -1;
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function add(Request $request) : void
    {
        $this->requests = array_slice($this->requests, 0, $this->position + 1);
        $this->requests[] = $request;
        $this->position++;
    }

    /**
     * @return Request
     *
     * @throws \LogicException
     */
    public function back() : Request
    {
        if ($this->position === -1) {
            throw new \LogicException('Cannot move back: the history is empty.');
        }
        if ($this->position === 0) {
            throw new \LogicException('Cannot move back: already on the first page.');
        }

        return $this->requests[--$this->position];
    }

    /**
     * @return Request
     *
     * @throws \LogicException
     */
    public function forward() : Request
    {
        if ($this->position === -1) {
            throw new \LogicException('Cannot move forward: the history is empty.');
        }
        if ($this->position === count($this->requests) - 1) {
            throw new \LogicException('Cannot move forward: already on the last page.');
        }

        return $this->requests[++$this->position];
    }

    /**
     * @return Request
     *
     * @throws \LogicException
     */
    public function current() : Request
    {
        if ($this->position === -1) {
            throw new \LogicException('The history is empty.');
        }

        return $this->requests[$this->position];
    }
}
