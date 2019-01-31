<?php
namespace cyrixbiz\acl\traits;

trait hasRelation
{
    /**
     * @param void
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function resources()
    {
        return $this->belongsToMany('\cyrixbiz\acl\Models\Resource', 'users_resources');

    }

    /**
     * @param void
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('\cyrixbiz\acl\Models\Role', 'users_roles');
    }
}