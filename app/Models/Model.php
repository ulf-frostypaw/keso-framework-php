<?php

namespace App\Models;

use mysqli;

class Model
{

    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;
    protected $query;
    protected $table;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($this->connection->connect_error) {
            die("Error al conectarse a MySQL: " . $this->connection->connect_error);
        }
    }

    // Función para ejecutar consultas preparadas
    public function executeQuery($sql, $data = [], $params = null)
    {
        if ($data) {
            if ($params == null) {
                $params = str_repeat('s', count($data));
            }

            $smnt = $this->connection->prepare($sql);
            $smnt->bind_param($params, ...$data);
            $smnt->execute();
        } else {
            $this->query = $this->connection->query($sql);
        }
        return $this;
    }

    // Obtener el primer resultado de la consulta
    public function first()
    {
        return $this->query->fetch_assoc();
    }

    // Obtener todos los resultados de la consulta
    public function get()
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    // BASIC CRUD Functions

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->executeQuery($sql)->get();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->executeQuery($sql, [$id], 'i')->first();
    }

    public function findBy($column, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        return $this->executeQuery($sql, [$value], 's')->get();
    }

    public function create($columns, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?, ', count($values) - 1) . "?)";
        $this->executeQuery($sql, $values);

        $insert_id = $this->connection->insert_id;
        return $this->findById($insert_id);
    }

    public function update($id, $data)
    {
        $fields = implode(', ', array_map(function ($key, $value) {
            return "{$key} = '{$value}'";
        }, array_keys($data), array_values($data)));

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";
        $this->executeQuery($sql, [$id]);

        return $this->findById($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->executeQuery($sql, [$id], 'i');
        return true;
    }
}
