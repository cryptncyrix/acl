<?php declare(strict_types=1);
namespace cyrixbiz\acl\Models\Resources;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resource
 * @package cyrixbiz\acl\Models
 */
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
     * The default Attributes Values
     * @var array
     */
    protected $attributes = [
        'default_access' => 0,
        'info' => 'Insert your Short Description'
    ];

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
        return $this->belongsToMany(config('acl.model.roles'), 'roles_resources');

    }

    /**
     * @param void
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'), 'users_resources');

    }
}