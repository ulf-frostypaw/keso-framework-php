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
        $this->connection();
    }

    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($this->connection->connect_error) {
            die("Error al conectarse a MySQL: " . $this->connection->connect_error);
        }
    }

    public function query($sql, $data = [], $params = null)
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
    public function first()
    {
        return $this->query->fetch_assoc();
    }
    public function get()
    {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    // consultas preparadas
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->get();
    }

    public function findByPk($id)
    {
        // SELECT * FROM myTable WHERE id = 1
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->first();
    }

    public function where($column, $operator, $value = null)
    {
        // SELECT * FROM myTable WHERE id = 1
        if ($value == null) {
            $value = $operator;
            $operator = '=';
        }
        $value = $this->connection->real_escape_string($value);
        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?";
        $this->query($sql, [$value], 's');
        /* $smnt = $this->connection->prepare($sql);
        $smnt->bind_param('s', $value);
        $smnt->execute();
        $this->query = $smnt->get_result(); */
        return $this;
    }

    public function create($data)
    {
        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?, ', count($values) - 1) . "?)";
        $this->query($sql, $values);

        $insert_id = $this->connection->insert_id;
        return $this->findByPk($insert_id);
    }

    public function update($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = '{$value}'";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";
        $values = array_values($data);
        $values[] = $id;

        $this->query($sql, $values);
        return $this->findByPk($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->query($sql, [$id], 'i');
        return true;
    }
}
