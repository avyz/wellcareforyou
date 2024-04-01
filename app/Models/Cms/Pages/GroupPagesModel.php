<?php

namespace App\Models\Cms\Pages;

use CodeIgniter\Model;

class GroupPagesModel extends Model
{
    public static function dataGroupPages($filter, $column, $order, $fullData)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "SELECT @no:=@no+1 AS number, `navbar_management_group_name`,
            `lang_code`,
            uuid,
            is_active,
            created_at,
            navbar_management_group_id FROM page_navbar_group_table, (SELECT @no:= 0) AS no 
            WHERE `navbar_management_group_name` LIKE '%$filter%' ORDER BY $column $order";
        } else {
            $query = "SELECT @no:=@no+1 AS number, `navbar_management_group_name`,
            `lang_code`,
            uuid,
            is_active,
            created_at,
            navbar_management_group_id FROM page_navbar_group_table, (SELECT @no:= 0) AS no 
            WHERE is_active = 1 AND `navbar_management_group_name` LIKE '%$filter%' ORDER BY $column $order";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataGroupPagesByPagesUuid($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `navbar_management_group_name`,
        `lang_code`,
        uuid,
        is_active,
        created_at,
        navbar_management_group_id FROM page_navbar_group_table 
        WHERE `uuid` = '$uuid'";

        $result = $db->query($query)->getRowArray();


        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataGroupChildPagesByManagementGroupUuid($navbar_management_group_uuid, $management_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `navbar_management_group_uuid`,
        `navbar_management_uuid`,
        `created_at`,
        `is_active` AS is_active_group_child,
        `uuid` AS navbar_management_group_child_uuid
        FROM page_navbar_group_child_table 
        WHERE `navbar_management_group_uuid` = '$navbar_management_group_uuid' AND `navbar_management_uuid` = '$management_uuid'";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
