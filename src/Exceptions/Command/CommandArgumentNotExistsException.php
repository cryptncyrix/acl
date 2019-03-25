<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Command;

use Exception;

/**
 * Class AclException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class CommandArgumentNotExistsException extends Exception
{
    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * AclMethodException constructor.
     * @param string $method
     */
    public function __construct()
    {
        $this->message = __('AclLang::exception.command_argument_not_exists');
    }

}