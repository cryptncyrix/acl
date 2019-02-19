<?php declare(strict_types=1);

namespace cyrixbiz\acl\Repositories\User;

use cyrixbiz\acl\Eloquent\Repository;

class UserRepository extends Repository
{
    public function model()
    {
        return config('acl.model.users');
    }
}