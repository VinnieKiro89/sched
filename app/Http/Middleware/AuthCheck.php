<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedUser') && ($request->path() !='auth/login')){
            return redirect()->route('auth.login')->with('fail', 'You must be logged in');
        }
        if(session()->has('LoggedUser') && ($request->path() =='auth/login')){
            return back();
        }

        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                                ->header('Pragma', 'no-cache')
                                ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
                                //->header('Content-Disposition', 'attachment; filename="test.xlsl"');

        // return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        //                     ->header('Pragma', 'no-cache')
        //                     ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
                            //->header('Content-Type', 'application/vnd.ms-excel');
                                

        // $response = new \Symfony\Component\HttpFoundation\Response($next($request));
        // $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        // $response->headers->set('Pragma', 'no-cache');
        // $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        // return $response;

    }
}
