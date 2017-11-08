<?php

namespace Brick\Browser\Tests\Mock;

use Brick\Http\MessageBodyString;
use Brick\Http\Request;
use Brick\Http\RequestHandler;
use Brick\Http\Response;

/**
 * An application mock to use in tests.
 */
class ApplicationMock implements RequestHandler
{
    /**
     * {@inheritdoc}
     */
    public function handle(Request $request): Response
    {
        $path = $request->getPath();

        $htmlFile = self::getHtmlFile($path);

        if ($htmlFile === null) {
            return self::notFoundResponse();
        }

        $htmlFile = __DIR__ . '/../html' . $htmlFile;

        if (! file_exists($htmlFile)) {
            return self::notFoundResponse();
        }

        $html = file_get_contents($htmlFile);

        if ($html === false) {
            throw new \RuntimeException('Could not read file "' . $htmlFile . '", check permissions.');
        }

        $response = new Response();
        $response->setHeader('Content-Type', 'text/html');
        $response->setBody(new MessageBodyString($html));

        return $response;
    }

    /**
     * @return Response
     */
    private static function notFoundResponse() : Response
    {
        $response = new Response();

        $response->setStatusCode(404, 'NOT FOUND');
        $response->setHeader('Content-Type', 'text/plain');
        $response->setBody(new MessageBodyString('The requested path was not found on this server.'));

        return $response;
    }

    /**
     * @param string $path
     *
     * @return string|null
     */
    public static function getHtmlFile(string $path) : ?string
    {
        if ($path === '') {
            return null;
        }

        if ($path[0] !== '/') {
            return null;
        }

        if (strpos($path, '//') !== false) {
            return null;
        }

        if ($path[-1] === '/') {
            $path .= 'index.html';
        } else {
            $path .= '.html';
        }

        return $path;
    }
}
