<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDirtyWord
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
        $dirtyWords = [
            '髒話',
            '真的好髒'
        ];
        $params = $request->all();

        foreach ($params as $key => $value) {
            if ($key === 'content') {
                foreach ($dirtyWords as $word) {
                    if (strpos($value, $word) !== false) {
                        return response('你壞壞喔', 400);
                    }
                }
            }
        }
        return $next($request);
    }
}
