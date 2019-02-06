<?php
namespace cyrixbiz\acl\traits;

/**
 * Trait hasRelation
 * @package cyrixbiz\acl\traits
 */
trait hasRelation
{
    /**
     * @param void
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function resources()
    {
        return $this->belongsToMany(config('acl.model.resources'), 'users_resources');

    }

    /**
     * @param void
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('acl.model.roles'), 'users_roles');
    }
}