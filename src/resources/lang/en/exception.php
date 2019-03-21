<?php declare(strict_types=1);

/**
 * Language File - Exceptions
 */
return
    [
        'method' => 'Middleware - Error | Function :name, don\'t Exists. Check your Config-File',
        'type' => 'Helper\helpers\hasResource Error - You can check only a Sring or an Array. :type given',
        'middleware' => 'Middleware - Error | Use for the :route - method  f.Example: ->name("foobar")',
        'unauthorized' => 'Login Required - Please Check your activity status',
        'permissen_denied' => 'This user doesn\'t have sufficient permissions.',
        'role_blocked' => 'This Role can\'t be deleted. It\'s a secure Role. Change the \'blockedRole\' in the Config-File.',
        'superAdmin' => 'This User can\'t be deleted. It\'s the superAdmin. Change the \'superAdmin\', in the Config-File.',
        'form'  => 'FormError - Param not in Old Array',
        'error_authorized' => 'Login Required',
        'back_login' => 'Back to Login'
    ];