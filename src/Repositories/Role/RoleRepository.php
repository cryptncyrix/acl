<?php declare(strict_types=1);

namespace cyrixbiz\acl\Repositories\Role;

use cyrixbiz\acl\Eloquent\Repository;
use cyrixbiz\acl\Exceptions\Acl\AclBlockedException;

/**
 * Class RoleRepository
 * @package cyrixbiz\acl\Repositories\Role
 */
class RoleRepository extends Repository
{
    /**
     * @return string
     */
    public function model() : string
    {
        return config('acl.model.roles');
    }

    /**
     * @param $id
     * @param array $where
     * @return int
     */
    public function delete($id, $where = [])  : int
    {
        throw_unless(config('acl.acl.blockedRole') != $id, AclBlockedException::class);
        if(!empty($where))
        {
            return $this->model
                ->where('id', '=', $id)
                ->where($where['attribute'], '=', $where['data'])
                ->delete();
        }
        return $this->model->destroy($id);
    }
}