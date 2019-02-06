<?php
namespace cyrixbiz\acl\controller;
use cyrixbiz\acl\traits\bindModel;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

/**
 * Class AclController
 * @package cyrixbiz\acl\controller
 */
class AclController
{
    use bindModel;
    /*
    |--------------------------------------------------------------------------
    | Acl Controller
    | Set / Remove Resource to / from User or Role
    |--------------------------------------------------------------------------
    */

    /**
     * AclController constructor.
     * @param Container $app
     */

    public function __construct(Container $app)
    {
        $this->roleModel = $this->bindModel(config('acl.model.roles'), $app);
        $this->resourceModel   = $this->bindModel(config('acl.model.resources'), $app);
        $this->userModel =  $this->bindModel(config('auth.providers.users.model'), $app);
    }

    /**
     * getPermissions
     *
     * Set the Form for Resourcemanagement -> resource/role || resource/user || role/user
     *
     * @param string $from // valid values: resource , role
     * @param string $to // valid values: role , user
     * @param int $id // id for param $to
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPermissions(string $from, string $to, int $id)
    {
        $permission = [];
        $fromModel = $this->{$from.'Model'}->all();
        $toModel = $this->{$to.'Model'}->all();

        if(hasResource($from. '.' . $to))
        {
            foreach ($fromModel as $valueFrom)
            {
                $permission[$valueFrom->id] = [0 => false, 1 => $valueFrom->name];
                foreach ($toModel->find($id)->{$from.'s'} as $valueTo)
                {
                    if($valueFrom->id == $valueTo->id)
                    {
                        $permission[$valueFrom->id] = [0 => true, 1 => $valueFrom->name];
                        break;
                    }

                }
            }

            return view('Acl::acl/getresource',
                ['from' => $this->{$to.'Model'}->find($id), // User -> ForExample Cyrix
                    'to'    => $permission, // All Roles ( Example )
                    'action' => $to.'.'.$from,
                    'id' => $id]);
        }


    }

    /**
     * Set the Permissions
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPermissions(Request $request)
    {
        $input  = $request->except('_id', '_token');
        $explodedAction = explode('.', $input['action']);
        if(hasResource($explodedAction[1].'.'.$explodedAction[0]))
        {
            $attach = $detach = [];
            foreach($input as $key => $value)
            {
                if(!is_int($key))
                {
                    continue;
                }

                if($value == true)
                {
                    if($input['old_' . $key] == 0)
                    {
                        $attach[] = $key;
                    }
                    continue;
                }
                else
                {
                    $detach[] = $key;
                }

            }

            if($attach != [])
            {
                $this->{$explodedAction[0].'Model'}->find($request->get('_id'))->{$explodedAction[1].'s'}()->attach($attach);

            }
            if($detach != [])
            {
                $this->{$explodedAction[0].'Model'}->find($request->get('_id'))->{$explodedAction[1].'s'}()->detach($detach);
            }

            return redirect()->route('acl.getPermissions', [$explodedAction[1], $explodedAction[0], $request->get('_id')]);
        }
        abort('401');
    }
}