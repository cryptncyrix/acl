<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;

use Exception;

/**
 * Class AclException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class AclMethodException extends Exception
{
    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * AclMethodException constructor.
     * @param string $method
     */
    public function __construct(string $method)
    {
        $this->message = __('AclLang::exception.method', ['name' => $method]);
    }

}