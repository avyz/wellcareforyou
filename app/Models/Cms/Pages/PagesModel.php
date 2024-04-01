<?php

namespace App\Models\Cms\Pages;

use CodeIgniter\Model;

class PagesModel extends Model
{
    public static function dataPages($filter, $column, $order, $fullData)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "SELECT @no:=@no+1 AS number, `navbar_management_name`,
            `lang_code`,
            navbar_management_url,
            uuid,
            is_active,
            page_number,
            created_at,
            navbar_management_whatsapp,
            navbar_management_meta_desc,
            navbar_management_id FROM page_navbar_table, (SELECT @no:= 0) AS no 
            WHERE `navbar_management_name` LIKE '%$filter%' ORDER BY $column $order";
        } else {
            $query = "SELECT @no:=@no+1 AS number, `navbar_management_name`,
            `lang_code`,
            navbar_management_url,
            uuid,
            is_active,
            page_number,
            created_at,
            navbar_management_whatsapp,
            navbar_management_meta_desc,
            navbar_management_id FROM page_navbar_table, (SELECT @no:= 0) AS no 
            WHERE is_active = 1 AND `navbar_management_name` LIKE '%$filter%' ORDER BY $column $order";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function getLastNumberPages()
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT COUNT(page_number) as last_number FROM page_navbar_table WHERE is_active = 1";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result['last_number'];
        } else {
            return null;
        }
    }

    public static function dataPagesByPagesUuid($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `navbar_management_name`,
        `lang_code`,
        navbar_management_url,
        uuid,
        is_active,
        page_number,
        created_at,
        navbar_management_whatsapp,
        navbar_management_meta_desc,
        navbar_management_id FROM page_navbar_table 
        WHERE `uuid` = '$uuid'";

        $result = $db->query($query)->getRowArray();


        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
