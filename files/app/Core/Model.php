<?php
namespace App\Core;

class Model extends QueryBuilder
{
    protected $table;

    public function __construct()
    {
        parent::__construct(); // QueryBuilder ka constructor call hoga (DB connection)
    }

    /**
     * Get all records
     */
    public function all()
    {
        return $this->table($this->table)->get();
    }

    /**
     * Find single record by ID
     */
    public function find($id)
    {
        return $this->table($this->table)
                    ->where('id', $id)
                    ->first();
    }

    /**
     * Insert new record
     */
    public function create($data)
    {
        return $this->table($this->table)
                    ->insert($data);
    }

    /**
     * Update record by ID
     */
    public function update($data)
    {
        return $this->table($this->table)
                    ->update($data);
    }

    /**
     * Delete record by ID
     */
    public function delete($id)
    {
        return $this->table($this->table)
                    ->delete($id);
    }
}