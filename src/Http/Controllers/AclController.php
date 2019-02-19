<?php declare(strict_types=1);
namespace cyrixbiz\acl\Http\Controllers;

use cyrixbiz\acl\Exceptions\Acl\AclException;
use cyrixbiz\acl\Http\Requests\Acl\AclRequest;
use cyrixbiz\acl\Repositories\Resource\ResourceRepository;
use cyrixbiz\acl\Repositories\Role\RoleRepository;
use cyrixbiz\acl\Repositories\User\UserRepository;
use Illuminate\Http\Request;

/**
 * Class AclController
 * @package cyrixbiz\acl\controller
 */
class AclController
{
    protected
        $roleRepository,
        $resourceRepository,
        $userRepository;


    /**
     * @var array
     */
    protected $valid = [
        'resource.role',
        'resource.user',
        'role.user'
    ];
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

    public function __construct(RoleRepository $roleRepository, ResourceRepository $resourceRepository, UserRepository $userRepository)
    {
            $this->roleRepository        = $roleRepository;
            $this->resourceRepository    = $resourceRepository;
            $this->userRepository        = $userRepository;

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
        $fromModel = $this->{$from.'Repository'}->all();
        $toModel = $this->{$to.'Repository'}->all();

        if(!in_array($from. '.' . $to , $this->valid) || !hasResource($from. '.' . $to))
        {
            abort(404);
        }

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
                ['from' => $this->{$to.'Repository'}->find($id), // User -> ForExample Cyrix
                    'to'    => $permission, // All Roles ( Example )
                    'action' => $to.'.'.$from,
                    'id' => $id]);



    }

    /**
     * Set the Permissions
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPermissions(AclRequest $request)
    {

        $input  = $request->validated();
        $explodedAction = explode('.', $input['action']);
        if(hasResource($explodedAction[1].'.'.$explodedAction[0]))
        {
            $attach = $detach = [];
            foreach($input['new'] as $key => $value)
            {
                if(!array_key_exists($key, $input['old']))
                {
                    throw new AclException('Param not in Old Array - FormError');
                }

                if($value == true)
                {
                    if($input['old'][$key] == 0)
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
                $this->{$explodedAction[0].'Repository'}->attach($attach, $explodedAction[1].'s', (int) $input['_id']);

            }
            if($detach != [])
            {
                $this->{$explodedAction[0].'Repository'}->detach($detach, $explodedAction[1].'s', (int) $input['_id']);
            }

            return redirect()->route('acl.getPermissions', [$explodedAction[1], $explodedAction[0], $input['_id']]);
        }
        abort('401');
    }
}