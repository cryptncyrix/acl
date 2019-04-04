<?php declare(strict_types=1);
namespace cyrixbiz\acl\traits;

use Illuminate\Support\Facades\Hash;

/**
 * Trait hasRelation
 * @package cyrixbiz\acl\traits
 */
trait hasRelation
{
    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        if(Hash::info($password) ['algoName'] == 'unknown' || Hash::needsRehash($password))
        {
            $this->attributes['password'] = Hash::make($password);
        }
    }

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