<?php namespace cyrixbiz\acl\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'resources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'default_access', 'info'];

    /**
     * Set Timestamps
     *
     * @var type
     */
    public $timestamps = false;


    /**
     * @param void
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('\cyrixbiz\acl\Models\Role', 'roles_resources');

    }

    /**
     * @param void
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('\cyrixbiz\acl\Models\User', 'users_resources');

    }
}