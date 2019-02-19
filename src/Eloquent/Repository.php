<?php declare(strict_types=1);

namespace cyrixbiz\acl\Eloquent;

use cyrixbiz\acl\Contracts\Repository\RepositoryInterface;
use cyrixbiz\acl\Exceptions\Repository\RepositoryException;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 * @package App\Database\Eloquent
 */
abstract class Repository implements RepositoryInterface     {

    /**
     * @var Container
     */
    private     $app;

    /**
     * @var $model
     */
    protected   $model;

    /**
     * Repository constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app  = $app;
        $this->bind();
    }

    /**
     * Set the Model
     * @return mixed
     */
    abstract function model();

    /**
     * @return Model|mixed
     * @throws RepositoryException
     */
    public function bind()
    {
        $model = $this->app->make($this->model());
        if(!$model instanceof Model)
        {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        }
        return $this->model = $model;
    }

    /**
     * @param array $columns
     * @param null $with
     * @return mixed
     */
    public function all($columns = ['*'], $with = null)
    {
        if(is_null($with))
        {
            return $this->model->get($columns);
        }
        return $this->model->with($with)->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 25, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, int $id, $attribute = "id") {
        return $this->model->where($attribute, '=', $id)->first()->update($data);
    }

    /**
     * @param $id
     * @param array $where
     * @return mixed
     */
    public function delete($id, $where = []) {
        if(!empty($where))
        {
            return $this->model
                ->where('id', '=', $id)
                ->where($where['attribute'], '=', $where['data'])
                ->delete();
        }
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @param null $with
     * @return mixed
     */
    public function find($id, $columns = ['*'], $with = null) {
        if(is_null($with))
        {
            return $this->model->find($id, $columns);
        }
        return $this->model->with($with)->find($id, $columns);

    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @param null $with
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'], $with = null) {
        if(is_null($with))
        {
            return $this->model->where($attribute, '=', $value)->first($columns);
        }
        return $this->model->with($with)->where($attribute, '=', $value)->first($columns);

    }

    /**
     * @param array $data
     * @param $table
     * @param int $id
     * @return mixed
     */
    public function attach(array $data, $table, $id = 0)
    {
        return $this->model->find($id)->{$table}()->attach($data);
    }

    /**
     * @param array $data
     * @param $table
     * @param int $id
     * @return mixed
     */
    public function detach(array $data, $table, $id = 0)
    {
        return $this->model->find($id)->{$table}()->detach($data);
    }
}