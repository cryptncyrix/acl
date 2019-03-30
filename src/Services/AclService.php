<?php declare(strict_types=1);
namespace cyrixbiz\acl\Services;

use Carbon\Carbon;
use cyrixbiz\acl\Repositories\Resource\ResourceRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class AclService
 * @package cyrixbiz\acl\Services
 */
class AclService {

    /**
     * auth
     * @var object
     */
    protected $auth;

    /**
     * user
     * @var object
     */
    protected $user;

    /**
     * superAdmin
     * @var object
     */
    protected $superAdmin = false;

    /**
     * superAdmin
     * @var object
     */
    protected $blockedRole = false;

    /**
     * resources
     * @var array
     */
    protected $resources = [];

    /**
     * AclService constructor.
     * @param ResourceRepository $resource
     * @param Guard $auth
     */
    public function __construct(ResourceRepository $resource, Guard $auth)
    {
        $this->resource = $resource;
        $this->auth = $auth;
        $this->getAllUserPermissions();
        $this->getAllTrueResources();
    }

    /**
     * @param $item
     * @return bool
     */
    public function hasResource($item) : bool
    {
        // SuperAdmin False, then check Blocked Member
        if($this->superAdmin === false)
        {
            // Blocked False, then Check resources
            if($this->blockedRole == false)
            {
                if(is_array($item))
                {
                    return $this->checkArray($item);
                }
                return $this->checkString($item);
            }
            // User ist blocked
            return false;
        }
        // User is SuperAdmin
        return true;
    }


    /**
     * Get all User Auth Data
     */
    public function getAllUserPermissions() : self
    {
        if(!$this->auth->guest())
        {
            $this->user = Cache::remember('user', Carbon::now()->addSeconds(config('acl.cache.time')), function ()
            {
                return $this->auth->user()->load('roles', 'roles.resources', 'resources');
            });

            $this->superAdmin = $this->setSuperAdmin();
            $this->blockedRole = $this->setBlockedRole($this->user->roles);
        }
        return $this;
    }

    /**
     * Get all true Resources
     *
     * @return array
     */
    public function getAllTrueResources() : array
    {
        foreach($this->resource->all() as $value)
        {
            if($this->checkUserPermissions($value['name'], boolval($value['default_access'])))
            {
                $this->resources[] = $value['name'];
            }
        }
        return $this->resources;
    }

    /**
     * Check the Resource of Rights
     * @param string $toCheckedString
     * @return boolean
     */
    public function checkUserPermissions(string $toCheckedString, bool $defaultAccess = null) : bool
    {
        if(!$this->auth->guest())
        {
            if( $this->getUserAccess($this->user->resources,  $toCheckedString)   )
            {
                // User - Resource
                return true;

            } else if( $this->getRoleAccess($this->user->roles,  $toCheckedString ) )
            {
                // User - Role
                // First DefaultAccess Role
                // Second Role - Resource
                return true;

            } else if( $this->getDefaultAccessFromResource($defaultAccess ) )
            {
                // Default Access Resource
                return true;
            }
        }
       return false;
    }

    /**
     * @param array $toCheckedArray
     * @return bool
     */
    protected function checkArray(array $toCheckedArray) : bool
    {
        foreach ($toCheckedArray as $value)
        {
            if(!in_array($value, $this->resources))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $toCheckedString
     * @return bool
     */
    protected function checkString(string $toCheckedString) : bool
    {
        return (in_array($toCheckedString, $this->resources));
    }

    /**
     * Get the default access for this resource
     *
     * @param  $stringName
     * @return bool
     */
    protected function getDefaultAccessFromResource(bool $defaultAccess) : bool
    {
        return $defaultAccess ?? false;
    }

    /**
     * Check - is the ressource set ;)
     *
     * @param  $objectResources
     * @param  $stringResource
     * @return bool
     */

    protected function getUserAccess(Collection $objectResources, string $stringResource) : bool
    {
        return (in_array($stringResource, $objectResources->pluck('name')->all()));
    }

    /**
     * Check - has the Role the Resource ;)
     *
     * @param  $objectRole
     * @param  $stringResource
     * @return bool
     */
    protected function getRoleAccess(Collection $objectRole, string $stringResource) : bool
    {
        foreach($objectRole as $value) {
            if($value->default_access == true)
            {
                return true;
            } else {

                $access = $this->getUserAccess($value->resources, $stringResource);
                if($access == false)
                {
                    continue;
                }
                return $access;
            }
        }
        return false;
    }

    /**
     * @param Collection $objectRole
     * @return bool
     */
    public function setBlockedRole(Collection $objectRole) : bool
    {
        return (in_array(config('acl.acl.blockedRole'), $objectRole->pluck('id')->all()));
    }

    /**
     * setSuperAdmin
     * @return bool
     */
    protected function setSuperAdmin() : bool
    {
        if(isset($this->user->id) && config('acl.acl.superAdmin') == $this->user->id)
        {
           return true;
        }
        return false;
    }
}