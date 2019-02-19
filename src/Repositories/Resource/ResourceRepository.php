<?php declare(strict_types=1);

namespace cyrixbiz\acl\Repositories\Resource;

use cyrixbiz\acl\Eloquent\Repository;

class ResourceRepository extends Repository
{
    public function model()
    {
        return config('acl.model.resources');
    }
}