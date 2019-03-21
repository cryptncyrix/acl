<?php declare(strict_types=1);

namespace cyrixbiz\acl\Repositories\User;

use cyrixbiz\acl\Eloquent\Repository;

/**
 * Class UserRepository
 * @package cyrixbiz\acl\Repositories\User
 */
class UserRepository extends Repository
{
    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function model()
    {
        return config('acl.model.users');
    }

    /**
     * @param $id
     * @param array $where
     * @return int
     */
    public function delete($id, $where = [])  : int
    {
        throw_unless(config('acl.acl.superAdmin') != $id, AclSuperAdminException::class);
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