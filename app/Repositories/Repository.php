<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface {

    /**
     * @var App
     */
    private $app;

    /**
     * Fully-qualified class name
     *
     * @var string
     */
    protected $model;

    /**
     * A space-delimited string containing field name and order to sort results by
     *
     * @var string
     */
    protected $orderBy;

    /**
     * Model instance used for querying
     *
     * @var
     */
    protected $modelInstance;

    /**
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @param array $columns    (Optional) Columns to select as array of strings
     * @param array $with       (Optional) Relationships to eager load as array of strings
     * @return Collection
     * @throws \RuntimeException
     */
    public function all($columns = ['*'], $with = []) : Collection {
        $query = $this->modelInstance->with($with);

        if (!empty($this->orderBy)) {
            $params = explode(' ', $this->orderBy);

            if (count($params) !== 2) {
                throw new \RuntimeException('orderBy property requires a space-delimited string containing field name and order.');
            }

            $query = $query->orderBy($params[0], $params[1]);
        }

        return $query->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*']) {
        return $this->modelInstance->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) : Model {
        return $this->modelInstance->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id') : Model {
        return $this->modelInstance->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) : bool {
        return $this->modelInstance->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']) : Model {
        return $this->modelInstance->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*']) : Model {
        return $this->modelInstance->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @return Builder
     * @throws RepositoryException
     */
    public function makeModel() : Builder {
        $modelInstance = $this->app->make($this->model);

        if (!$modelInstance instanceof Model)
            throw new RepositoryException("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->modelInstance = $modelInstance->newQuery();
    }
}