<?php
namespace App\Core;

use App\Core\Database;

class QueryBuilder
{
    protected $conn;
    protected $table;
    protected $query;
    protected $bindings = [];

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    /**
     * Set table
     */
    public function table($table)
    {
        $this->table = $table;
        $this->query = "SELECT * FROM {$table}";
        $this->bindings = [];
        return $this;
    }

    /**
     * Where condition
     */
    public function where($column, $value)
    {
        $this->query .= " WHERE {$column} = ?";
        $this->bindings[] = $value;
        return $this;
    }

    /**
     * Get all records
     */
    public function get()
    {
        $stmt = $this->conn->prepare($this->query);

        if (!empty($this->bindings)) {
            $stmt->bind_param(
                str_repeat("s", count($this->bindings)),
                ...$this->bindings
            );
        }

        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get single record
     */
    public function first()
    {
        $this->query .= " LIMIT 1";
        $result = $this->get();
        return $result[0] ?? null;
    }

    /**
     * Insert record
     */
    public function insert($data)
    {
        $columns = implode(",", array_keys($data));
        $placeholders = implode(",", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            str_repeat("s", count($data)),
            ...array_values($data)
        );

        return $stmt->execute();
    }

    /**
     * Update record (by ID)
     */
    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);

        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
        }

        $setString = implode(",", $set);

        $sql = "UPDATE {$this->table} SET {$setString} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        $values = array_values($data);
        $values[] = $id;

        $stmt->bind_param(
            str_repeat("s", count($values)),
            ...$values
        );

        return $stmt->execute();
    }

    /**
     * Delete record
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}