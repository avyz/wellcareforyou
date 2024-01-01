<?php

namespace App\Models\People;

use CodeIgniter\Model;

class PeopleModel extends Model
{
    public static function dataPeople($perPage, $offset, $search, $is_pagination)
    {
        $instance = new static();
        $db = $instance->getDb();

        $query = "";
        if ($is_pagination) {
            if ($search) {
                $query = "SELECT * FROM people WHERE nama LIKE '%$search%' LIMIT $offset, $perPage";
            } else {
                $query = "SELECT * FROM people LIMIT $offset, $perPage";
            }
        } else {
            if ($search) {
                $query = "SELECT * FROM people WHERE nama LIKE '%$search%'";
            } else {
                $query = "SELECT * FROM people";
            }
        }

        $result = $db->query($query)->getResultArray();
        return $result;
    }

    // INSERT DATA
    public static function insertData($data, $throw_id, $table)
    {
        $instance = new static();
        $result = $instance->insertDatas($data, $throw_id, $table);
        return $result;
    }

    // UPDATE DATA
    public static function updateData($column_data, $data, $table)
    {
        $instance = new static();
        $result = $instance->updateDatas($column_data, $data, $table);
        return $result;
    }

    // DELETE DATA
    public static function deleteData($columns_id, $id, $data, $table, $hard_delete)
    {
        $instance = new static();
        $result = $instance->deleteDatas($columns_id, $id, $data, $table, $hard_delete);
        return $result;
    }
}
