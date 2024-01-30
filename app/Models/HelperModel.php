<?php

namespace App\Models;

use CodeIgniter\Model;

class HelperModel extends Model
{
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

    // GET DAY
    public static function helperDays($datetime_column, $where, $table, $request)
    {
        $instance = new static();
        $result = $instance->helperDay($datetime_column, $where, $table, $request);
        return $result;
    }
}
