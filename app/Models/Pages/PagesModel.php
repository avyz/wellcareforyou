<?php

namespace App\Models\Pages;

use CodeIgniter\Model;

class PagesModel extends Model
{
    public static function dataComics($slug = false)
    {
        $instance = new static();
        $db = $instance->getDb();

        if ($slug == false) {
            return $db->query("SELECT * FROM comics")->getResultArray();
        }

        $comics = $db->query("SELECT * FROM comics WHERE slug = '$slug'")->getRowArray();
        return $comics;
    }

    // INSERT DATA
    public static function insertData($data, $throw_id, $table)
    {
        $instance = new static();
        $db = $instance->insertDatas($data, $throw_id, $table);
        return $db;
    }

    // UPDATE DATA
    public static function updateData($column_data, $data, $table)
    {
        $instance = new static();
        $db = $instance->updateDatas($column_data, $data, $table);
        return $db;
    }

    // DELETE DATA
    public static function deleteData($columns_id, $id, $data, $table, $hard_delete)
    {
        $instance = new static();
        $db = $instance->deleteDatas($columns_id, $id, $data, $table, $hard_delete);
        return $db;
    }
}
