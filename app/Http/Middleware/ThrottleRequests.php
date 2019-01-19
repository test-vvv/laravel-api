<?php

namespace App\Http\Middleware;

class ThrottleRequests extends \Illuminate\Routing\Middleware\ThrottleRequests
{

    /**
     * Resolve request signature.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     *
     * @throws \RuntimeException
     */
    protected function resolveRequestSignature($request)
    {
        if ($route = $request->route()) {
            return sha1(geoip($request->ip())->getAttribute('iso_code'));
        }

        throw new \RuntimeException('Unable to generate the request signature. Route unavailable.');
    }
}
