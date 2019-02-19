<?php declare(strict_types=1);
namespace cyrixbiz\acl\Middleware;

use Closure;
use cyrixbiz\acl\Exceptions\Acl\AclException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class Acl
 * @package cyrixbiz\acl\Middleware
 */
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
    public function handle(Request $request, Closure $next)
    {
        //dd($this->splitAction($request));
        //dd(strrchr($request->route()->getAction()['controller'], '\\'));

        if(config('acl.acl.enable') === true)
        {
            if ( hasResource($this->checkMethod($request)) )
            {
                return $next($request);
            }
            return ($request->ajax()) ? response('Unauthorized.', 401) : abort(401);
        }
        return $next($request);
    }

    /**
     * Use name or action method
     *
     * @param $request
     * @return string
     */
    private function checkMethod(Request $request)
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

    /**
     * Split the Controller-Action to dotString
     *
     * @param $request
     * @return string
     */

    private function splitAction(Request $request)
    {

        if(strpos($request->route()->getActionName(), '@'))
        {
            $action = substr(strrchr($request->route()->getActionName(), '\\') , 1);
            return strtolower(stristr($action , 'Controller', true) . '.' . substr(stristr($action , '@'), 1));
        }

        return $this->fallback($request);
    }

    /**
     * @param $request
     * @return mixed
     * @throws AclException
     */
    private function fallback($request)
    {
        if(is_null($request->route()->getName()))
        {
            throw new AclException('Middleware - Error | Use for  {{' . $request->route()->getActionName() . '}} the Name - method  f.Example: ->name("foobar")');
        }
        return $request->route()->getName();
    }

}
