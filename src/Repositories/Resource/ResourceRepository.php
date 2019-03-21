<?php declare(strict_types=1);

namespace cyrixbiz\acl\Repositories\Resource;

use cyrixbiz\acl\Eloquent\Repository;

/**
 * Class ResourceRepository
 * @package cyrixbiz\acl\Repositories\Resource
 */
class ResourceRepository extends Repository
{
    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public function model()
    {
        return config('acl.model.resources');
    }
}