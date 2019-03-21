<?php

namespace TopviewDigital\LangSwitcher\Middleware;

use Closure;
use TopviewDigital\LangSwitcher\Model\LangSwitcher as Model;

class LangSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Model::setLocale();

        return $next($request);
    }
}
