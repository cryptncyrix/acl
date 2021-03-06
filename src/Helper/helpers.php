<?php declare(strict_types=1);

/**
 * hasResource
 *
 * Check the Rights for the Resource
 *
 * @param string $name
 * @return bool
 */
function hasResource($name) : bool
{
    throw_unless(is_array($name) || is_string($name), new \cyrixbiz\acl\Exceptions\Acl\AclHelperException($name));
    return app('aclservice')->hasResource($name);
}

/**
 * @param $error
 * @param bool $field
 * @return null|string
 */
function showError(array $error, $field = false) : ?string
{
    if (count($error) > 0) {
        if($field && !$error->has($field)) {
            return null;
        }
        return'<span class="text-danger form-error">' . $error->get($field)[0] . '</span>';
    }
    return null;

}