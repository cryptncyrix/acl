<?php

/**
 * hasResource
 *
 * Check the Rights for the Resource
 *
 * @param string $name
 * @return bool
 */
function hasResource($name)
{
    return app('aclhelper')->hasResource($name);
}

/**
 * @param $error
 * @param bool $field
 * @return null|string
 */
function showError($error, $field = false)
{
    if (count($error) > 0) {
        if($field && !$error->has($field)) {
            return null;
        }
        return'<span class="text-danger form-error">' . $error->get($field)[0] . '</span>';
    }
    return null;

}