<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FnxPublic
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
        $useWWW = getSetting('seo_use_www');
        $host=$request->header('host');
        $hasWWW = substr($host, 0, 4) =='www.';

        if(!$hasWWW && $useWWW){
            $request->headers->set('host', 'www.'.$host);
            return redirect($request->path());
        }

        if($hasWWW && !$useWWW){
            $request->headers->set('host',substr($host, 4));
            return redirect($request->path());
        }
        

        return $next($request);
    }
}
