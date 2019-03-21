<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;


use Exception;

/**
 * Class AclException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class AclSuperAdminException extends Exception
{
    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * AclSuperAdminException constructor.
     */
    public function __construct()
    {
        $this->message = __('AclLang::exception.superAdmin');
    }
}