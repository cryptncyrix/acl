<?php namespace cyrixbiz\acl\seeds;

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
        DB::table('roles')->insert(
            [
                'name' => 'Admin',
                'default_access' => true,
                'info' => 'Administrator - Global  Rights',
            ]);
        DB::table('roles')->insert(
            [
                'name' => 'Full Member',
                'default_access' => false,
                'info' => 'Member - Full Rights',
            ]);
        DB::table('roles')->insert(
            [
                'name' => 'Low Member',
                'default_access' => false,
                'info' => 'Member - Low Rights',
            ]);
        DB::table('roles')->insert(
            [
                'name' => 'Guest',
                'default_access' => false,
                'info' => 'Member - No Internal Rights',
            ]);
        DB::table('roles')->insert(
            [
                'name' => 'Blocked Member',
                'default_access' => false,
                'info' => 'Member - No Rights',
            ]);

        /*
         * Resources
         */

        DB::table('resources')->insert(
            [
                'name' => 'home',
                'default_access' => true,
                'info' => 'Startseite',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'role.index',
                'default_access' => false,
                'info' => 'Overview Roles',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'role.create',
                'default_access' => false,
                'info' => 'Create a Role Form',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'role.store',
                'default_access' => false,
                'info' => 'Store the Role',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'role.show',
                'default_access' => false,
                'info' => 'Show the Role',
            ]);

        DB::table('resources')->insert(
            [
                'name' => 'role.edit',
                'default_access' => false,
                'info' => 'Edit the Role Form',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'role.update',
                'default_access' => false,
                'info' => 'Update the Role',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'role.destroy',
                'default_access' => false,
                'info' => 'Destroy the Role',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'resource.index',
                'default_access' => false,
                'info' => 'Overview Resources',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'resource.create',
                'default_access' => false,
                'info' => 'Create the Resource Form',
            ]);

        DB::table('resources')->insert(
            [
                'name' => 'resource.store',
                'default_access' => false,
                'info' => 'Store the Resource',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'resource.show',
                'default_access' => false,
                'info' => 'Show the Resource',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'resource.edit',
                'default_access' => false,
                'info' => 'Edit the Resource Form',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'resource.update',
                'default_access' => false,
                'info' => 'Update the Resource',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'resource.destroy',
                'default_access' => false,
                'info' => 'Destroy the Resource',
            ]);

        DB::table('resources')->insert(
            [
                'name' => 'user.index',
                'default_access' => false,
                'info' => 'Overview Users',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'user.create',
                'default_access' => false,
                'info' => 'Create the User Form',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'user.store',
                'default_access' => false,
                'info' => 'Store the User',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'user.show',
                'default_access' => false,
                'info' => 'Show the User',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'user.edit',
                'default_access' => false,
                'info' => 'Edit the User Form',
            ]);

        DB::table('resources')->insert(
            [
                'name' => 'user.update',
                'default_access' => false,
                'info' => 'Update the User Form',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'user.destroy',
                'default_access' => false,
                'info' => 'Destroy the User',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'acl.getPermissions',
                'default_access' => false,
                'info' => 'Get Permissions to Role, User and User Role Form',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'acl.setPermissions',
                'default_access' => false,
                'info' => 'Set Permissions to Role, User and User Role Form',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'role.user',
                'default_access' => false,
                'info' => 'Give User Roles - It will Checked in acl.getPermissions and acl.setPermissions',
            ]);

        DB::table('resources')->insert(
            [
                'name' => 'resource.user',
                'default_access' => false,
                'info' => 'Give User Resources - It will Checked in acl.getPermissions and acl.setPermissions',
            ]);
        DB::table('resources')->insert(
            [
                'name' => 'resource.role',
                'default_access' => false,
                'info' => 'Give Roles Resources -It will Checked in acl.getPermissions and acl.setPermissions',
            ]);
    }
}
