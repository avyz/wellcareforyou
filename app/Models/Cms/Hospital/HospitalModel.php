<?php

namespace App\Models\Cms\Hospital;

use CodeIgniter\Model;

class HospitalModel extends Model
{
    public static function dataHospital($filter, $column, $order)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS number, T0.`hospital_id`,
            T0.`uuid`,
            T0.hospital_location_uuid,
            T0.hospital_image,
            T0.hospital_name,
            T0.hospital_address,
            T0.hospital_phone,
            T0.hospital_map_location,
            T0.is_center,
            T0.created_at,
            T1.hospital_location_name,
            T1.hospital_location_code
            FROM (SELECT @no:= 0) AS no, hospital_table T0
            LEFT JOIN hospital_location_table T1 ON T1.uuid = T0.hospital_location_uuid
            WHERE T0.`hospital_name` LIKE '%$filter%' ORDER BY $column $order";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataLocation($filter, $column, $order)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS number, 
        T0.`hospital_location_id`,
        T0.`uuid`,
        T0.`lang_uuid`,
        T0.hospital_location_name,
        T0.hospital_location_code,
        T0.created_at,
        T1.language
        FROM (SELECT @no:= 0) AS no, hospital_location_table T0 
        LEFT JOIN lang_table T1 ON T0.lang_uuid = T1.uuid
        WHERE T0.is_deleted = 0 AND (T0.hospital_location_name LIKE '%$filter%' OR T1.language LIKE '%$filter%') ORDER BY $column $order";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataArrayLocationByLangUuid($lang_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS `number`, 
        T0.`hospital_location_id`,
        T0.`uuid`,
        T0.`lang_uuid`,
        T0.hospital_location_name,
        T0.hospital_location_code,
        T0.created_at,
        T1.language
        FROM (SELECT @no:= 0) AS `no`, hospital_location_table T0 
        LEFT JOIN lang_table T1 ON T0.lang_uuid = T1.uuid
        WHERE T0.is_deleted = 0 AND T0.lang_uuid = '$lang_uuid' ORDER BY `number` ASC";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataLocationByLangUuidAndHospitalLocationName($lang_uuid, $hospital_location_name)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS number, 
        T0.`hospital_location_id`,
        T0.`uuid`,
        T0.`lang_uuid`,
        T0.hospital_location_name,
        T0.hospital_location_code,
        T0.created_at,
        T1.language
        FROM (SELECT @no:= 0) AS no, hospital_location_table T0 
        LEFT JOIN lang_table T1 ON T0.lang_uuid = T1.uuid
        WHERE T0.is_deleted = 0 AND T0.lang_uuid = '$lang_uuid' AND T0.hospital_location_name = '$hospital_location_name' ORDER BY `number` ASC";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
