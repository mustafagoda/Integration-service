<?php

declare(strict_types=1);

namespace App\Domain\Shared\Repositories\Classes;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

abstract class AbstractRepository
{
    /**
     * @param Model $model
     */
    public function __construct(
        protected Model $model
    ) {
    }

    public function firstOrCreate(array $condition, array $data, bool $withoutEvent = false): Model
    {
        if ($withoutEvent) {
            return $this->model->withoutEvents(function () use ($condition, $data) {
                return $this->model->firstOrCreate($condition, $data);
            });
        } else {
            return $this->model->firstOrCreate($condition, $data);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function listAllBy(array $conditions = [], array $relations = [], array $select = ['*'], string $orderBy = 'id', string $orderType = 'DESC', array $orConditions = []): array|Collection
    {
        return $this->prepareQuery($conditions, $orConditions, $relations, $select)->orderBy($orderBy, $orderType)->get();
    }

    /**
     * @param array $conditions
     * @param array $orConditions
     * @param array $relations
     * @param array $select
     * @return Model|Builder
     */
    public function firstOrFail(array $conditions = [], array $relations = [], array $select = ['*'], array $orConditions = []): Model|Builder
    {
        return $this->prepareQuery($conditions, $orConditions, $relations, $select)
            ->firstOrFail();
    }

    public function first(array $conditions = [], array $relations = [], array $select = ['*'], array $orConditions = []): Model|Builder|null
    {
        return $this->prepareQuery($conditions, $orConditions, $relations, $select)
            ->first();
    }

    /**
     * @param array $conditions
     * @param array $relations
     * @param array $select
     * @param array $orConditions
     * @return Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function prepareQuery(array $conditions = [], array $orConditions = [], array $relations = [], array $select = ['*']): Builder|\Illuminate\Database\Eloquent\Builder
    {
        return $this->model
            ->with($relations)
            ->where($conditions)
            ->orWhere($orConditions)
            ->select($select);
    }
}
