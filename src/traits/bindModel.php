<?php declare(strict_types=1);
namespace cyrixbiz\acl\traits;

use cyrixbiz\acl\Exceptions\AclException;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait bindModel
 * @package cyrixbiz\acl\traits
 */
trait bindModel
{
    /**
     * @param $stringModel
     * @param Container $app
     * @return Model|mixed
     * @throws \Exception
     */
    public function bindModel(string $stringModel, Container $app)
    {
        $model = $app->make($stringModel);
        if(!$model instanceof Model)
        {
            throw new AclException("Class {$stringModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        }
        return $this->model = $model;
    }
}