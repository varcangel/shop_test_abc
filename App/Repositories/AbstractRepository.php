<?php
namespace App\Repositories;

use System\Factory;

abstract class AbstractRepository
{
    protected $entity;

    public function __construct(string $entityName, array $args)
    {
        $this->entity = Factory::setupEntity($entityName, $args);
    }

    public function __destruct()
    {
        $this->entity = null;
    }

    /**
     * Store a new Entity
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        $this->entity->insert($params);
    }

    /**
     * Delete a entity, find by id
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id)
    {
        return $this->entity->delete('id', $id);
    }

    /**
     * Update a entity in bd, find by id
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function updateById(array $params, int $id)
    {
        $this->entity->update($params, $id);
    }

    /**
     * Find a entity by id
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->entity->selectWhere('id',$id);
        return $result;
    }

    /**
     * Get all records
     * @param array $columns
     * @return mixed
     */
    public function getAllRecord($columns = ['*'])
    {
        return $this->entity->select($columns);
    }

    /**
     * Find By a Column name
     * @param string $nameColumn
     * @param mixed $data
     * @return mixed
     */
    public function findByColumnName(string $nameColumn, $data)
    {
        $result = $this->entity->selectWhere($nameColumn,$data);
        return $result;
    }
}