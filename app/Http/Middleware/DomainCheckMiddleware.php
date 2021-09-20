<?php

namespace App\Http\Middleware;

use App\Models\CallWidget;
use Closure;
use Illuminate\Http\Request;

class DomainCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        // In this example, we are only allowing the third party to include the "iframe" route
        // It's always better to scope this to a given route / set of routes to avoid any unattended security problems
        if ($request->routeIs('click-to-call')) {
            $domain = $request->input('domain');
            $allowedDomains = CallWidget::whereIdentifier($request->input('identifier'))->value('domains');

            if(in_array($domain, $allowedDomains)){
                header("X-Frame-Options: ALLOW-FROM $domain");
                header("Content-Security-Policy: frame-ancestors $domain");
            } else {
                header("X-Frame-Options: ALLOW-FROM DENY");
                header("Content-Security-Policy: frame-ancestors DENY");
            }
        }

        return ($next($request));
    }
}
