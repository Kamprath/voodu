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
     * @throws RepositoryException
     */
    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get all models
     *
     * @param array $columns    (Optional) Columns to select as array of strings
     * @param array $with       (Optional) Relationships to eager load as array of strings mapped to orderBy strings.
     *                          Example: ['robots' => 'created_at asc', 'robots.parts' => 'name asc']
     * @return Collection       Returns models as a collection
     * @throws \RuntimeException
     */
    public function all(array $columns = ['*'], array $with = []) : Collection {
        $with = self::createEagerLoadArray($with);
        $query = $this->modelInstance->with($with);

        if (!empty($this->orderBy)) {
            $params = explode(' ', $this->orderBy);

            if (\count($params) !== 2) {
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
     * @return Model
     * @throws RepositoryException
     */
    public function update(array $data, $id) : Model {
        $model = $this->modelInstance->find($id);
        $model->update($data);
        $this->makeModel();

        return $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) : bool {
        return $this->modelInstance->where('id', $id)->delete();
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

    /**
     * Create an array of ordered relationships that can be passed to Model::with()
     *
     * @param array $with Relationships mapped to field and order as an associative array of strings.
     *                      Example: ['robots' => 'created_at asc', 'robots.parts' => 'name asc']
     * @return array        Returns an array usable as an argument for Model::with()
     * @throws \RuntimeException
     */
    protected static function createEagerLoadArray(array $with): array
    {
        if (empty($with)) {
            return [];
        }

        foreach ($with as $relationship => $orderBy) {
            $params = explode(' ', $orderBy);

            if (\count($params) !== 2) {
                throw new \RuntimeException('$with array values must contain space-delimited string containing field name and order.');
            }

            $with[$relationship] = function ($query) use ($params) {
                $query->orderBy($params[0], $params[1]);
            };
        }
        return $with;
    }
}