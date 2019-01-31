<?php namespace cyrixbiz\acl\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Acl {

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($this->splitAction($request));
        //dd(strrchr($request->route()->getAction()['controller'], '\\'));

        if(config('acl.acl.enable') === true)
        {
            if ( hasResource($this->checkMethod($request)) )
            {
                return $next($request);
            }
            return ($request->ajax()) ? response('Unauthorized.', 401) : abort(401) /*response()->view('errors.401', [], 401)*/;
        }
        return $next($request);
    }

    /**
     * Split the Controller-Action to dotString
     *
     * @param $request
     * @return string
     */

    private function splitAction($request)
    {
        $action = substr(strrchr($request->route()->getAction()['controller'], '\\') , 1);
        $name = strtolower(stristr($action , 'Controller', true) . '.' . substr(stristr($action , '@'), 1));
        return $name;
    }

    /**
     * Use name or action method
     *
     * @param $request
     * @return string
     */
    private function checkMethod($request)
    {
        if(config('acl.acl.method') == 'name')
        {
            return $request->route()->getName();
        }
        elseif (config('acl.acl.method') == 'action')
        {
            return $this->splitAction($request);
        }
        else
        {
            abort( 404 );
        }
    }

}
