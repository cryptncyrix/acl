<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;

use Exception;

/**
 * Class AclBlockedException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class AclBlockedException extends Exception
{
    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * AclBlockedException constructor.
     */
    public function __construct()
    {
        $this->message = __('AclLang::exception.role_blocked');
    }
}