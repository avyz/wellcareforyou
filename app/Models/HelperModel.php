<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class HelperModel extends Model
{
    // INSERT DATA
    public static function insertData($data, $throw_id, $table)
    {

        $instance = new static();
        $db = $instance->db;

        // Kolom dan nilai data
        $columns = implode(',', array_keys($data));
        $values = "'" . implode("','", array_values($data)) . "'";

        // Query INSERT INTO
        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

        $result = $db->query($query);

        if ($throw_id) {
            return $db->insertID();
        }

        return $result;
    }

    // UPDATE DATA
    public static function updateData($column_data, $data, $table)
    {
        $instance = new static();
        $db = $instance->db;

        $setStatements = [];
        foreach ($data as $column => $value) {
            $setStatements[] = "{$column} = " . (is_string($value) ? "'{$value}'" : $value);
        }

        $setClause = implode(', ', $setStatements);

        $whereStatements = [];
        foreach ($column_data as $column => $value) {
            $whereStatements[] = "{$column} = " . (is_string($value) ? "'{$value}'" : $value);
        }

        $whereClause = implode(' AND ', $whereStatements);

        $query = "UPDATE {$table} SET {$setClause} WHERE {$whereClause}";

        $result = $db->query($query);
        return $result;
    }

    // DELETE DATA
    public static function deleteData($columns_id, $id, $data, $table, $hard_delete)
    {
        $instance = new static();
        $db = $instance->db;

        if ($hard_delete == true) {
            // QUERY HARD DELETE
            $query = "DELETE FROM {$table} WHERE {$columns_id} = ?";
        } else {

            $updateColumns = [];
            foreach ($data as $column => $value) {
                if (is_numeric($column)) {
                    // Jika hanya value yang diberikan tanpa nama kolom, gunakan default 'is_delete' dan 'deleted_at'
                    $updateColumns['is_delete'] = 1;
                    $updateColumns['deleted_at'] = 'NOW()';
                } else {
                    $updateColumns[$column] = $value;
                }
            }

            $setStatements = [];
            foreach ($updateColumns as $column => $value) {
                $setStatements[] = "{$column} = " . (is_string($value) ? "'{$value}'" : $value);
            }

            $setClause = implode(', ', $setStatements);

            $query = "UPDATE {$table} SET {$setClause} WHERE {$columns_id} = ?";
        }
        $result = $db->query($query, [$id]);
        return $result;
    }

    // GENERATE UUID
    public static function generateUuid()
    {
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }

    // GET DAY
    // public static function helperDays($datetime_column, $where, $table, $request)
    // {
    //     $instance = new static();
    //     $result = $instance->helperDay($datetime_column, $where, $table, $request);
    //     return $result;
    // }
}
