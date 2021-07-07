<?php

namespace Marshmallow\HelperFunctions;

use InvalidArgumentException;
use \Illuminate\Support\Facades\URL;
use Illuminate\Support\InteractsWithTime;

class UrlHelper extends URL
{
    use InteractsWithTime;

    public function isCurrent($url)
    {
        if ($url === request()->url() || $url === request()->path()) {
            return true;
        }

        return false;
    }

    public function isInternal($url)
    {
        return strpos($url, config('app.url')) === 0;
    }

    public function escape($url)
    {
        return str_replace('/', '\\\\/', $url);
    }

    public function routeUriExists($uri)
    {
        $routes = \Route::getRoutes()->getRoutes();
        foreach ($routes as $r) {
            if ($r->uri == $uri) {
                return true;
            }
        }

        return false;
    }

    public function buildFromArray(array $url_parts): string
    {
        $url_parts = array_filter($url_parts);
        $route = '/';
        foreach ($url_parts as $part) {
            $part = rtrim($part, '/');
            $part = ltrim($part, '/');

            if (substr($route, -1) !== '/' && substr($part, 0, 1) !== '/') {
                $route .= '/';
            }
            $route .= $part;
        }

        return $route;
    }

    public function isNova($request)
    {
        return (isset($request->segments()[0]) && in_array($request->segments()[0], [
            'nova-api',
            'nova-vendor',
            ltrim(config('nova.path'), '/'),
        ]));
    }

    public function isNotNova($request)
    {
        return (!$this->isNova($request));
    }

    /**
     * Create a signed route URL for a named route.
     *
     * @param  string  $name
     * @param  mixed  $parameters
     * @param  \DateTimeInterface|\DateInterval|int|null  $expiration
     * @param  bool  $absolute
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function signed($path, $expiration = null, $absolute = true)
    {
        $parameters = [];

        if (array_key_exists('signature', $parameters)) {
            throw new InvalidArgumentException(
                '"Signature" is a reserved parameter when generating signed routes. Please rename your route parameter.'
            );
        }

        if ($expiration) {
            $parameters = $parameters + ['expires' => $this->availableAt($expiration)];
        }

        ksort($parameters);

        $key = config('app.key');
        $signature_path = $path . '?' . http_build_query($parameters);

        $parameters = $parameters + [
            'signature' => hash_hmac('sha256', $signature_path, $key),
        ];

        return $path . '?' . http_build_query($parameters);

        return $this->route($name, $parameters + [
            'signature' => hash_hmac('sha256', $this->route($name, $parameters, $absolute), $key),
        ], $absolute);
    }
}
