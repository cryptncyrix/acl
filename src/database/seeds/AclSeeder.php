<?php namespace cyrixbiz\acl\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AclSeeder extends Seeder
{
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

        DB::table('roles')->updateOrInsert(
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Admin',
                'default_access' => true,
                'info' => 'Administrator - Global  Rights',
            ]);

        DB::table('roles')->updateOrInsert(
            [
                'name' => 'Full Member',
            ],
            [
                'name' => 'Full Member',
                'default_access' => false,
                'info' => 'Member - Full Rights',
            ]);
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'Low Member',
            ],
            [
                'name' => 'Low Member',
                'default_access' => false,
                'info' => 'Member - Low Rights',
            ]);
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'Guest',
            ],
            [

                'name' => 'Guest',
                'default_access' => false,
                'info' => 'Member - No Internal Rights',
            ]);
        DB::table('roles')->updateOrInsert(
            [
                'name' => 'Blocked Member',
            ],
            [
                'name' => 'Blocked Member',
                'default_access' => false,
                'info' => 'Member - No Rights',
            ]);

        /*
         * Resources
         */

        DB::table('resources')->updateOrInsert(
            [
                'name' => 'home',
            ],
            [
                'name' => 'home',
                'default_access' => true,
                'info' => 'Startseite',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.index',
            ],
            [
                'name' => 'role.index',
                'default_access' => false,
                'info' => 'Overview Roles',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.create',
            ],
            [
                'name' => 'role.create',
                'default_access' => false,
                'info' => 'Create a Role Form',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.store',
            ],
            [
                'name' => 'role.store',
                'default_access' => false,
                'info' => 'Store the Role',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.show',
            ],
            [
                'name' => 'role.show',
                'default_access' => false,
                'info' => 'Show the Role',
            ]);

        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.edit',
            ],
            [
                'name' => 'role.edit',
                'default_access' => false,
                'info' => 'Edit the Role Form',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.update',
            ],
            [
                'name' => 'role.update',
                'default_access' => false,
                'info' => 'Update the Role',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.destroy',
            ],
            [
                'name' => 'role.destroy',
                'default_access' => false,
                'info' => 'Destroy the Role',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.index',
            ],
            [
                'name' => 'resource.index',
                'default_access' => false,
                'info' => 'Overview Resources',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.create',
            ],
            [
                'name' => 'resource.create',
                'default_access' => false,
                'info' => 'Create the Resource Form',
            ]);

        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.store',
            ],
            [
                'name' => 'resource.store',
                'default_access' => false,
                'info' => 'Store the Resource',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.show',
            ],
            [
                'name' => 'resource.show',
                'default_access' => false,
                'info' => 'Show the Resource',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.edit',
            ],
            [
                'name' => 'resource.edit',
                'default_access' => false,
                'info' => 'Edit the Resource Form',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.update',
            ],
            [
                'name' => 'resource.update',
                'default_access' => false,
                'info' => 'Update the Resource',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.destroy',
            ],
            [
                'name' => 'resource.destroy',
                'default_access' => false,
                'info' => 'Destroy the Resource',
            ]);

        DB::table('resources')->updateOrInsert(
            [
                'name' => 'user.index',
            ],
            [
                'name' => 'user.index',
                'default_access' => false,
                'info' => 'Overview Users',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'user.create',
            ],
            [
                'name' => 'user.create',
                'default_access' => false,
                'info' => 'Create the User Form',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'user.store',
            ],
            [
                'name' => 'user.store',
                'default_access' => false,
                'info' => 'Store the User',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'user.show',
            ],
            [
                'name' => 'user.show',
                'default_access' => false,
                'info' => 'Show the User',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'user.edit',
            ],
            [
                'name' => 'user.edit',
                'default_access' => false,
                'info' => 'Edit the User Form',
            ]);

        DB::table('resources')->updateOrInsert(
            [
                'name' => 'user.update',
            ],
            [
                'name' => 'user.update',
                'default_access' => false,
                'info' => 'Update the User Form',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'user.destroy',
            ],
            [
                'name' => 'user.destroy',
                'default_access' => false,
                'info' => 'Destroy the User',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'acl.getPermissions',
            ],
            [
                'name' => 'acl.getPermissions',
                'default_access' => false,
                'info' => 'Get Permissions to Role, User and User Role Form',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'acl.setPermissions',
            ],
            [
                'name' => 'acl.setPermissions',
                'default_access' => false,
                'info' => 'Set Permissions to Role, User and User Role Form',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'acl.setRoutes',
            ],
            [
                'name' => 'acl.setRoutes',
                'default_access' => false,
                'info' => 'Set Routes as Resources',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'role.user',
            ],
            [
                'name' => 'role.user',
                'default_access' => false,
                'info' => 'Give User Roles - It will Checked in acl.getPermissions and acl.setPermissions',
            ]);

        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.user',
            ],
            [
                'name' => 'resource.user',
                'default_access' => false,
                'info' => 'Give User Resources - It will Checked in acl.getPermissions and acl.setPermissions',
            ]);
        DB::table('resources')->updateOrInsert(
            [
                'name' => 'resource.role',
            ],
            [
                'name' => 'resource.role',
                'default_access' => false,
                'info' => 'Give Roles Resources -It will Checked in acl.getPermissions and acl.setPermissions',
            ]);
    }
}
