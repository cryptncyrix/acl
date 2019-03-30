<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Command;

use Exception;

/**
 * Class CommandArgumentNotExistsException
 * @package cyrixbiz\acl\Exceptions\Command
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