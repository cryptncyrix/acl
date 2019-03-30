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
         * UserId with Full Rights
         *
         * This User is a special User
         * He has global Rights, He can't be deleted.
         * Default: 1 | Change this to
         */

        'superAdmin' => 1,

        /**
         * All Member in this Role don't have Rights
         *
         * This Group is a special Role
         * He has zero Rights, He can't be deleted.
         * Users in this Role, lost all her Permissions
         * Default: 5 | Change this to your Role
         */

        'blockedRole' => 5,

        /**
         * Use RouteName or RouteAction
         *
         * Default: getActionName
         * Alternative: getName|getActionName
         */

        'method' => [
            'active'   => 'getActionName',
            'fallback' => 'getName'
        ],

    ],

    /**
     * Cache
     */
    'cache' => [

        /**
         * Set Cache Time in Seconds
         *
         * Default: 60
         */

        'time' => 60
    ],

    /**
     * Models
     */

    'model' => [
        'roles'     => 'cyrixbiz\acl\Models\Role\Role',
        'resources' => 'cyrixbiz\acl\Models\Resource\Resource',
    ],

];