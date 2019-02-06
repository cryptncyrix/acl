<?php namespace cyrixbiz\acl\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AclRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
