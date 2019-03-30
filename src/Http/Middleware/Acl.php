<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Middleware;

use Closure;
use cyrixbiz\acl\Exceptions\Acl\AclException;
use cyrixbiz\acl\Exceptions\Acl\AclMethodException;
use cyrixbiz\acl\Exceptions\Acl\AclMiddlewareException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(config('acl.acl.enable') === true)
        {
            if(Auth::guest())
            {
                return response()->view('AclView::errors/401', [], 401);
            }
            if (hasResource($this->checkMethod($request)) )
            {
                return $next($request);
            }

            throw AclException::permissen_denied();
            //return ($request->ajax()) ? response('Unauthorized.', 401) : redirect()->route('login');
        }
        return $next($request);

    }

    /**
     * Use getName or getActionName method
     *
     * @param $request
     * @return string
     */
    private function checkMethod(Request $request) : ?string
    {
        foreach (config('acl.acl.method') as $value)
        {
            throw_unless(method_exists($request->route(), $value), new AclMethodException($value));
            $item = $this->{$value}($request);
            if(is_null($item))
            {
                continue;
            }
            return $item;
        }
        throw new AclMiddlewareException($request->route()->getActionName());

    }

    /**
     * @param Request $request
     * @return bool|string
     */
    private function getName(Request $request) : ?string
    {
        if(is_null($request->route()->getName()))
        {
            return null;
        }
        return $request->route()->getName();
    }

    /**
     * @param Request $request
     * @return bool|string
     */

    private function getActionName(Request $request) : ?string
    {
        if(strpos($request->route()->getActionName(), '@'))
        {
            $action = substr(strrchr($request->route()->getActionName(), '\\') , 1);
            return strtolower(stristr($action , 'Controller', true)) . '.' . substr(stristr($action , '@'), 1);
        }
        return null;
    }
}
