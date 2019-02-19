<?php declare(strict_types=1);
namespace cyrixbiz\acl\Helper;

use cyrixbiz\acl\Models\Resource;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;

/**
 * Class AclHelper
 * @package cyrixbiz\acl\Helper
 */
class AclHelper {

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
     * resources
     * @var array
     */
    protected $resources = [];


    /**
     *
     * @param Resource $resource
     * @param Guard $auth
     */

    public function __construct(Resource $resource, Guard $auth)
    {
        $this->resource = $resource;
        $this->auth = $auth;;
        $this->getAllUserPermissions();
        $this->getAllTrueResources();
    }


    /**
     * Get all User Auth Data
     * @return \cyrixbiz\acl\Helper\AclHelper
     */

    public function getAllUserPermissions()
    {
        if(!$this->auth->guest())
        {
            $this->user = $this->auth->user();
            $this->user->load('roles', 'roles.resources', 'resources');
            $this->superAdmin = $this->setSuperAdmin();
        }

    }

    /**
     * Get all true Resources
     *
     * @return array
     */
    public function getAllTrueResources()
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

    public function checkUserPermissions(string $toCheckedString, bool $defaultAccess = null)
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
     * Check the User Rights
     * @param string $toCheckedString
     * @return type
     */
    public function hasResource( $toCheckedString)
    {
        if($this->superAdmin === false)
        {
            if(is_array($toCheckedString))
            {
                foreach ($toCheckedString as $value)
                {
                    if(!in_array($value, $this->resources))
                    {
                        return false;
                    }
                }
                return true;
            }
            return (in_array($toCheckedString, $this->resources));
        }
        return true;
    }

    /**
     * Get the default access for this resource
     *
     * @param  $stringName
     * @return bool
     */

    protected function getDefaultAccessFromResource(bool $defaultAccess)
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

    protected function getUserAccess(Collection $objectResources, string $stringResource)
    {

        foreach($objectResources as $value) {
            if($value->name == $stringResource){
                return true;
            }
        }
        return false;
    }

    /**
     * Check - has the Role the Resource ;)
     *
     * @param  $objectRole
     * @param  $stringResource
     * @return bool
     */

    protected function getRoleAccess(Collection $objectRole, string $stringResource)
    {

        foreach($objectRole as $value) {
            if($value->default_access == true)
            {
                return true;

            } else {

                return $this->getUserAccess($value->resources, $stringResource);
            }
        }
        return false;
    }

    /**
     * setSuperAdmin
     * @return bool
     */
    protected function setSuperAdmin()
    {
        if(isset($this->user->id) && config('acl.acl.superAdmin') == $this->user->id)
        {
           return true;
        }
        return false;
    }
}