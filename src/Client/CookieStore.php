<?php

declare(strict_types=1);

namespace Brick\Browser\Client;

use Brick\Http\Request;
use Brick\Http\Response;
use Brick\Http\Cookie;

/**
 * Cookie storage for the HTTP client.
 *
 * @see http://tools.ietf.org/html/rfc6265
 */
class CookieStore
{
    /**
     * @var ClientCookie[]
     */
    private $cookies = [];

    /**
     * Adds a cookie to the store.
     *
     * @param Cookie       $cookie The cookie.
     * @param CookieOrigin $origin The cookie origin.
     *
     * @return void
     */
    public function addCookie(Cookie $cookie, CookieOrigin $origin) : void
    {
        $cookie = new ClientCookie($cookie, $origin);
        $this->cookies[$cookie->hash()] = $cookie;
    }

    /**
     * Updates the cookie store from a Request/Response pair.
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return void
     */
    public function update(Request $request, Response $response) : void
    {
        $origin = CookieOrigin::createFromRequest($request);

        foreach ($response->getCookies() as $cookie) {
            $this->addCookie($cookie, $origin);
        }
    }

    /**
     * Returns the active cookies matching the given origin.
     *
     * @param CookieOrigin $origin
     *
     * @return ClientCookie[]
     */
    public function get(CookieOrigin $origin) : array
    {
        $this->deleteExpiredCookies();

        $cookies = array_filter($this->cookies, static function(ClientCookie $cookie) use ($origin) {
            return $cookie->matches($origin);
        });

        usort($cookies, static function(ClientCookie $a, ClientCookie $b) {
            return $a->compareTo($b);
        });

        return $cookies;
    }

    /**
     * Returns the active cookies matching the given host & path as an associative array.
     *
     * Note that duplicate cookie names would be overwritten here.
     *
     * @param CookieOrigin $origin
     *
     * @return array
     */
    public function getAsArray(CookieOrigin $origin) : array
    {
        $cookies = [];

        foreach ($this->get($origin) as $cookie) {
            $cookies[$cookie->getName()] = $cookie->getValue();
        }

        return $cookies;
    }

    /**
     * Returns the active cookies matching the given host & path as a string.
     *
     * The resulting string can be used as a Cookie header by the client.
     *
     * @param CookieOrigin $origin
     *
     * @return string
     */
    public function getAsString(CookieOrigin $origin) : string
    {
        $cookies = $this->get($origin);

        $pairs = array_map(static function(ClientCookie $cookie) {
            return $cookie->toString();
        }, $cookies);

        return implode('; ', $pairs);
    }

    /**
     * @return void
     */
    private function deleteExpiredCookies() : void
    {
        foreach ($this->cookies as $key => $cookie) {
            if ($cookie->isExpired()) {
                unset($this->cookies[$key]);
            }
        }
    }
}
