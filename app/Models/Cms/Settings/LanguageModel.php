<?php

namespace App\Models\Cms\Settings;

use CodeIgniter\Model;

class LanguageModel extends Model
{

    public static function dataLanguage($filter, $column, $order, $fullData)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "SELECT @no:=@no+1 AS number, `language`,
            `lang_code`,
            lang_icon,
            is_active,
            is_lang_default,
            uuid,
            created_at,
            lang_id FROM lang_table, (SELECT @no:= 0) AS no 
            WHERE `language` LIKE '%$filter%' ORDER BY $column $order";
        } else {
            $query = "SELECT @no:=@no+1 AS number, `language`,
            `lang_code`,
            lang_icon,
            is_active,
            is_lang_default,
            uuid,
            created_at,
            lang_id FROM lang_table, (SELECT @no:= 0) AS no 
            WHERE is_active = 1 AND `language` LIKE '%$filter%' ORDER BY $column $order";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataLanguageByLangUuid($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `language`,
        `lang_code`,
        lang_icon,
        is_active,
        is_lang_default,
        uuid,
        created_at,
        lang_id FROM lang_table 
        WHERE `uuid` = '$uuid'";

        $result = $db->query($query)->getRowArray();


        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
