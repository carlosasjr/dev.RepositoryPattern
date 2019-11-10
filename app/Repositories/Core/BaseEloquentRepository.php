<?php

namespace App\Repositories\Core;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\NotEntityDefined;

class BaseEloquentRepository implements RepositoryInterface
{
    protected $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->entity->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * @param $column
     * @param $valor
     * @return mixed
     */
    public function findWhere($column, $valor)
    {
      return $this->entity->where($column, $valor)
                          ->get();
    }

    /**
     * @param $column
     * @param $valor
     * @return mixed
     */
    public function findWhereFirst($column, $valor)
    {
        return $this->entity->where($column, $valor)
                            ->firt();
    }

    /**
     * @param int $totalPage
     * @return mixed
     */
    public function paginate($totalPage = 10)
    {
        return $this->entity->paginate($totalPage);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return $this->entity->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $entity = $this->findById($id);

        return $entity->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $entity = $this->findById($id);

        return $entity->delete();
    }

    /**
     * @param $column
     * @param string $order
     * @return $this
     *
     */
    public function orderBy($column, $order = 'DESC')
    {
        $this->entity = $this->entity->orderBy($column, $order);

        return $this;
    }


    public function relationships(...$relationships)
    {
        $this->entity = $this->entity->with($relationships);

        return $this;
    }


    public function resolveEntity()
    {
        if (!method_exists($this, 'entity'))
        {
            throw new NotEntityDefined;
        }

        return app($this->entity());
    }
}


