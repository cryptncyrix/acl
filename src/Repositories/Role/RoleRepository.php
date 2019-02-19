<?php declare(strict_types=1);

namespace cyrixbiz\acl\Repositories\Role;

use cyrixbiz\acl\Eloquent\Repository;

class RoleRepository extends Repository
{
    public function model()
    {
        return config('acl.model.roles');
    }
}