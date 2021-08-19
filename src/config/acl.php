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
         * This Role is for all new active Members
         *
         * Members receive this Role after an active registration
         */

        'newMemberRole' => 3,

        /**
         * All Members in this Role have no Rights
         *
         * This Group is a special Role
         * and has zero Rights, This Group can't be deleted.
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
        'roles'     => \cyrixbiz\acl\Models\Roles\Role::class,
        'resources' => \cyrixbiz\acl\Models\Resources\Resource::class,
    ],
];