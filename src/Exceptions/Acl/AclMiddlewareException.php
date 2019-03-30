<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;

use Exception;

/**
 * Class AclMiddlewareException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class AclMiddlewareException extends Exception
{
    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * AclMiddlewareException constructor.
     * @param string $action
     */
    public function __construct(string $action)
    {
        $this->message = __('AclLang::exception.middleware', ['route' => $action]);
    }
}