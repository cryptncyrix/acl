<?php declare(strict_types=1);
namespace cyrixbiz\acl\Contracts\Repository;

/**
 * Interface RepositoryInterface
 * @package cyrixbiz\acl\Contracts\Repository
 */
interface RepositoryInterface {

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'], $with = null);

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 25, $columns = ['*']);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, int $id, $attribute = "id");

    /**
     * @param $id
     * @param array $where
     * @return mixed
     */
    public function delete($id, $where = []);

    /**
     * @param $id
     * @param array $columns
     * @param null $with
     * @return mixed
     */
    public function find($id, $columns = ['*'], $with = null);

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @param null $with
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*'], $with = null);


}