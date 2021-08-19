<?php namespace cyrixbiz\acl\database\seeds;

use cyrixbiz\acl\Models\Resources\Resource;
use cyrixbiz\acl\Models\Roles\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AclSeeder extends Seeder
{
    private

        /**
         * @var array
         */
        $aIds = [],

        /**
         * @var int
         */
        $role_id = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Roles
         */

        $object = Role::updateOrCreate(
            [
                'name' => 'Admin',
                'default_access' => true,
                'info' => 'Administrator - Global  Rights',
            ]
        );

        $this->aIds['Admin'] = ['role_id' => $object->id];

        $object = Role::updateOrCreate(
            [
                'name' => 'Full Member',
                'default_access' => false,
                'info' => 'Member - Full Rights',
            ]
        );

        $this->aIds['Full Member'] = ['role_id' => $object->id];

        $object = Role::updateOrCreate(
            [
                'name' => 'Low Member',
                'default_access' => false,
                'info' => 'Member - Low Rights',
            ]
        );

        $this->aIds['Low Member'] = ['role_id' => $object->id];

        $object = Role::updateOrCreate(
            [
                'name' => 'Blocked Member',
                'default_access' => false,
                'info' => 'Member - No Rights',
            ]
        );

        $this->aIds['Blocked Member'] = ['role_id' => $object->id];

        /*
         * Resources
         */

        $object = Resource::updateOrCreate(
            [
                'name' => 'home',
                'default_access' => false,
                'info' => 'First Seite - For non-Admin',
            ]
        );

        $this->aIds['Admin'][] = $object->id;
        $this->aIds['Full Member'][] = $object->id;
        $this->aIds['Low Member'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'logout',
                'default_access' => false,
                'info' => 'Logout from the Secure-Area',
            ]
        );

        $this->aIds['Admin'][] = $object->id;
        $this->aIds['Full Member'][] = $object->id;
        $this->aIds['Low Member'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.index',
                'default_access' => false,
                'info' => 'Overview Roles',
            ]
        );

        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.create',
                'default_access' => false,
                'info' => 'Create a Role Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.store',
                'default_access' => false,
                'info' => 'Store the Role',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.show',
                'default_access' => false,
                'info' => 'Show the Role',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.edit',
                'default_access' => false,
                'info' => 'Edit the Role Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.update',
                'default_access' => false,
                'info' => 'Update the Role',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.destroy',
                'default_access' => false,
                'info' => 'Destroy the Role',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.index',
                'default_access' => false,
                'info' => 'Overview Resources',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.create',
                'default_access' => false,
                'info' => 'Create the Resource Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.store',
                'default_access' => false,
                'info' => 'Store the Resource',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.show',
                'default_access' => false,
                'info' => 'Show the Resource',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.edit',
                'default_access' => false,
                'info' => 'Edit the Resource Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.update',
                'default_access' => false,
                'info' => 'Update the Resource',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.destroy',
                'default_access' => false,
                'info' => 'Destroy the Resource',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'user.index',
                'default_access' => false,
                'info' => 'Overview Users',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'user.create',
                'default_access' => false,
                'info' => 'Create the User Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'user.store',
                'default_access' => false,
                'info' => 'Store the User',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'user.show',
                'default_access' => false,
                'info' => 'Show the User',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'user.edit',
                'default_access' => false,
                'info' => 'Edit the User Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'user.update',
                'default_access' => false,
                'info' => 'Update the User Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'user.destroy',
                'default_access' => false,
                'info' => 'Destroy the User',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'acl.getPermissions',
                'default_access' => false,
                'info' => 'Get Permissions to Role, User and User Role Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'acl.setPermissions',
                'default_access' => false,
                'info' => 'Set Permissions to Role, User and User Role Form',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'acl.setRoutes',
                'default_access' => false,
                'info' => 'Set Routes as Resources',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'role.user',
                'default_access' => false,
                'info' => 'Give User Roles - It will Checked in acl.getPermissions and acl.setPermissions',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.user',
                'default_access' => false,
                'info' => 'Give User Resources - It will Checked in acl.getPermissions and acl.setPermissions',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        $object = Resource::updateOrCreate(
            [
                'name' => 'resource.role',
                'default_access' => false,
                'info' => 'Give Roles Resources -It will Checked in acl.getPermissions and acl.setPermissions',
            ]
        );
        $this->aIds['Admin'][] = $object->id;

        foreach ($this->aIds as $value)
        {
            foreach ($value as $resource => $resource_id)
            {
                if(!is_int($resource)) {
                    $this->role_id = head($value);
                    continue;
                }

                DB::table('roles_resources')->insert(
                    [
                        'role_id' => $this->role_id,
                        'resource_id' => $resource_id,
                    ]
                );
            }
        }
    }
}
