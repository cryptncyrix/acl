<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Repository;

use Exception;

/**
 * Class RepositoryException
 * @package cyrixbiz\acl\Exceptions\Repository
 */
class RepositoryException extends Exception {

    /**
     * @var array|null|string
     */
    protected $message;

    /**
     * RepositoryException constructor.
     * @param string $method
     */
    public function __construct($class, $type)
    {
        $this->message = __('AclLang::exception.repository_model_type', ['class' => $class, 'type' => $type]);
    }
}