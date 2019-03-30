<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;

use Exception;

/**
 * Class AclHelperException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class AclHelperException extends Exception
{
    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * AclHelperException constructor.
     * @param string $method
     */
    public function __construct($type)
    {
        $this->message = __('AclLang::exception.type', ['type' => gettype($type)]);
    }
}