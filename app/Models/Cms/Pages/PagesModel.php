<?php

namespace App\Models\Cms\Pages;

use CodeIgniter\Model;

class PagesModel extends Model
{
    public static function dataPages($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            if ($lang_code) {
                if ($filter) {
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
                    WHERE lang_code = '$lang_code' AND `navbar_management_name` LIKE '%$filter%' ORDER BY $column $order";
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
                    WHERE lang_code = '$lang_code' ORDER BY $column $order";
                }
            } else {
                if ($filter) {
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
                    WHERE lang_code = 'en' AND `navbar_management_name` LIKE '%$filter%' ORDER BY $column $order";
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
                    WHERE lang_code = 'en' ORDER BY $column $order";
                }
            }
        } else {
            if ($lang_code) {
                if ($filter) {
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
                    WHERE is_active = 1 AND lang_code = '$lang_code' AND `navbar_management_name` LIKE '%$filter%' ORDER BY $column $order";
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
                    WHERE is_active = 1 AND lang_code = '$lang_code' ORDER BY $column $order";
                }
            } else {
                if ($filter) {
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
                    WHERE lang_code = 'en' AND is_active = 1 AND `navbar_management_name` LIKE '%$filter%' ORDER BY $column $order";
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
                    WHERE lang_code = 'en' AND is_active = 1 ORDER BY $column $order";
                }
            }
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function getLastNumberPages($lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT COUNT(page_number) as last_number FROM page_navbar_table WHERE is_active = 1 AND lang_code = '$lang_code'";

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
