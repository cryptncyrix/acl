<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;


use Exception;

/**
 * Class AclException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class AclFormException extends Exception
{
    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * AclFormException constructor.
     */
    public function __construct()
    {
        $this->message = __('AclLang::exception.form');
    }
}