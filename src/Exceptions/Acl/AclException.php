<?php declare(strict_types=1);
namespace cyrixbiz\acl\Exceptions\Acl;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class AclException
 * @package cyrixbiz\acl\Exceptions\Acl
 */
class AclException extends HttpException
{
    /**
     * @return AclException
     */
    public static function unauthorized() : self
    {
        return new static(403, __('AclLang::exception.unauthorized'), null, []);
    }

    /**
     * @return AclException
     */
    public static function permissen_denied() : self
    {
        return new static(403, __('AclLang::exception.permissen_denied'), null, []);
    }

    /**
     * @return AclException
     */
    public static function superAdmin() :self
    {
        return new static(403, __('AclLang::exception.superAdmin'), null, []);
    }
}