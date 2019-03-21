<?php declare(strict_types=1);

namespace cyrixbiz\acl\Eloquent;

use cyrixbiz\acl\Contracts\Repository\RepositoryInterface;
use cyrixbiz\acl\Exceptions\Repository\RepositoryException;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @return Model
     * @throws RepositoryException
     */
    public function bind() : Model
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
     * @return Collection
     */
    public function all($columns = ['*'], $with = null) : Collection
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
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 25, $columns = ['*']) : LengthAwarePaginator
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data) : Model
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function insert(array $data) : bool
    {
        return $this->model->insert($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @param string $attribute
     * @return bool
     */
    public function update(array $data, int $id, $attribute = "id")  : Bool
    {
        return $this->model->where($attribute, '=', $id)->first()->update($data);
    }

    /**
     * @param $id
     * @param array $where
     * @return int
     */
    public function delete($id, $where = [])  : int
    {

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
     * @return Model
     */
    public function find($id, $columns = ['*'], $with = null)  : Model
    {
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
     * @return Model
     */
    public function findBy($attribute, $value, $columns = ['*'], $with = null)  : Model
    {
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
     * @return int|null
     */
    public function attach(array $data, $table, $id = 0) : ?int
    {
        return $this->model->find($id)->{$table}()->attach($data);
    }

    /**
     * @param array $data
     * @param $table
     * @param int $id
     * @return int|null
     */
    public function detach(array $data, $table, $id = 0) : ?int
    {
        if(empty($data))
        {
            return $this->model->find($id)->{$table}()->detach();
        }
        return $this->model->find($id)->{$table}()->detach($data);
    }
}