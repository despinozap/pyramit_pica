<?php

namespace App\Http\Middleware;

use Closure;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);

        if($request->user())
        {
            if($request->user()->active == false)
            {
                return redirect()->route('front.blocked');
            }
            else if($request->user()->type == 'admin')
            {
                if(
                    $request->is('panel') ||
                    $request->is('panel/401') ||
                    $request->is('panel/videos') ||
                    $request->is('panel/changePassword') ||
                    $request->is('panel/categories') ||
                    $request->is('panel/categories/*') ||
                    $request->is('panel/articles') ||
                    $request->is('panel/articles/*') ||
                    $request->is('panel/comments') ||
                    $request->is('panel/comments/*') ||
                    $request->is('panel/documents') ||
                    $request->is('panel/documents/*') ||
                    $request->is('panel/albums') ||
                    $request->is('panel/albums/*') ||
                    $request->is('panel/wells') ||
                    $request->is('panel/wells/*') ||
                    $request->is('panel/users') ||
                    $request->is('panel/users/*') ||
                    $request->is('panel/configuration/*')
                )
                {
                    return $next($request);
                }
                else
                {
                    return redirect()->route('panel.401');
                }

                return redirect()->route('panel.index');
            }
            else if($request->user()->type == 'editor')
            {
                if(
                    $request->is('panel') ||
                    $request->is('panel/401') ||
                    $request->is('panel/videos') ||
                    $request->is('panel/changePassword') ||
                    $request->is('panel/categories') ||
                    $request->is('panel/categories/*') ||
                    $request->is('panel/articles') ||
                    $request->is('panel/articles/*') ||
                    $request->is('panel/comments') ||
                    $request->is('panel/comments/*') ||
                    $request->is('panel/albums') ||
                    $request->is('panel/albums/*')
                )
                {
                    return $next($request);
                }
                else
                {
                    return redirect()->route('panel.401');
                }
            }
        }

        return redirect()->route('panel.index');
    }
}
