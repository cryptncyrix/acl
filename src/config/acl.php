<?php

return [

    /**
     * Check the Route
     */

    'acl' => [

        /**
         * Use RouteScan
         *
         * Default: true
         */

        'enable' => true,

        /**
         * Use RouteName or RouteAction
         *
         * Default: action
         * Alternative: name|action
         */

        'method' => 'action',

        /**
         * UserId with Full Rights
         *
         * This User is a special User
         * He has global Rights, He can't be deleted.
         * Default: 1 | Change this to
         */

        'superAdmin' => 1
    ],

    /**
     * Not Implemented
     *
     */
    'cache' => [

        /**
         * Set Cache Time in minutes
         *
         * Default: 10
         */

        'time' => 10
    ],

    'model' => [
        'roles'     => 'cyrixbiz\acl\Models\Role',
        'resources' => 'cyrixbiz\acl\Models\Resource',

        // Don' Change this Line
        'users'     => config('auth.providers.users.model'), // use from auth Config File

    ],

];