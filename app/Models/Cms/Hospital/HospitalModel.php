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
            T0.hospital_image,
            T0.hospital_name,
            T0.hospital_code,
            T0.created_at,
            T1.hospital_location_uuid,
            T1.hospital_address,
            T1.hospital_phone,
            T1.hospital_map_location,
            T1.is_center,
            T2.hospital_location_name,
            T2.hospital_location_code,
            T3.uuid AS hospital_country_uuid,
            T3.lang_code,
            T3.language AS hospital_country
            FROM (SELECT @no:= 0) AS no, hospital_table T0
            LEFT JOIN hospital_address_table T1 ON T1.hospital_uuid = T0.uuid
            LEFT JOIN hospital_location_table T2 ON T2.uuid = T1.hospital_location_uuid
            LEFT JOIN lang_table T3 ON T2.lang_uuid = T3.uuid
            WHERE T0.is_deleted = 0 AND T1.is_center = 1 AND T0.`hospital_name` LIKE '%$filter%' ORDER BY $column $order";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataHospitalWithBranch($filter, $column, $order)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS number, T0.`hospital_id`,
            T0.`uuid`,
            T0.hospital_image,
            T0.hospital_name,
            T0.hospital_code,
            T0.created_at,
            T1.`hospital_branch_id`,
            T1.`uuid` AS branch_uuid,
            T1.hospital_uuid,
            T1.hospital_location_uuid,
            T1.hospital_address,
            T1.hospital_phone,
            T1.hospital_map_location,
            T1.is_center,
            T2.hospital_location_name,
            T2.hospital_location_code,
            T3.lang_code,
            T3.language AS hospital_country
            FROM (SELECT @no:= 0) AS no, hospital_table T0
            LEFT JOIN hospital_address_table T1 ON T1.hospital_uuid = T0.uuid
            LEFT JOIN hospital_location_table T2 ON T2.uuid = T1.hospital_location_uuid
            LEFT JOIN lang_table T3 ON T2.lang_uuid = T3.uuid
            WHERE T0.is_deleted = 0 AND T1.is_deleted = 0 ORDER BY $column $order";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataHospitalBranchByHospitalUuidAndAddress($hospital_uuid, $hospital_address)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS `number`, T0.`hospital_branch_id`,
            T0.`uuid`,
            T0.hospital_uuid,
            T0.hospital_location_uuid,
            T0.hospital_address,
            T0.hospital_phone,
            T0.hospital_map_location,
            T0.created_at,
            T1.hospital_name,
            T1.hospital_code,
            T2.hospital_location_name,
            T3.lang_code,
            T3.language AS hospital_country
            FROM (SELECT @no:= 0) AS no, hospital_address_table T0
            LEFT JOIN hospital_table T1 ON T1.uuid = T0.hospital_uuid
            LEFT JOIN hospital_location_table T2 ON T2.uuid = T0.hospital_location_uuid
            LEFT JOIN lang_table T3 ON T2.lang_uuid = T3.uuid
            WHERE T0.is_deleted = 0 AND T0.is_center = 0 AND T0.`hospital_uuid` = '$hospital_uuid' AND T0.`hospital_address` = '$hospital_address' ORDER BY `number` ASC";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataHospitalBranch($hospital_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS `number`, T0.`hospital_branch_id`,
            T0.`uuid`,
            T0.hospital_uuid,
            T0.hospital_location_uuid,
            T0.hospital_address,
            T0.hospital_phone,
            T0.hospital_map_location,
            T0.created_at,
            T1.hospital_name,
            T1.hospital_code,
            T2.hospital_location_name,
            T3.lang_code,
            T3.language AS hospital_country
            FROM (SELECT @no:= 0) AS no, hospital_address_table T0
            LEFT JOIN hospital_table T1 ON T1.uuid = T0.hospital_uuid
            LEFT JOIN hospital_location_table T2 ON T2.uuid = T0.hospital_location_uuid
            LEFT JOIN lang_table T3 ON T2.lang_uuid = T3.uuid
            WHERE T0.is_deleted = 0 AND T0.is_center = 0 AND T0.`hospital_uuid` = '$hospital_uuid' ORDER BY `number` ASC";

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
        T1.lang_code,
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
        T1.lang_code,
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
        T1.lang_code,
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

    // Hospital Package
    public static function dataPackageByHospitalUuid($filter, $column, $order, $fullData, $hospital_uuid, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($filter) {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.`hospital_package_id`,
            T0.`uuid`,
            T0.`hospital_uuid`,
            T0.package,
            T0.created_at,
            T0.package_title,
            T1.uuid AS lang_uuid,
            T1.lang_code,
            T1.language,
            T2.hospital_name,
            T2.hospital_code
            FROM (SELECT @no:= 0) AS no, hospital_package_table T0 
            LEFT JOIN lang_table T1 ON T0.lang_uuid = T1.uuid
            LEFT JOIN hospital_table T2 ON T0.hospital_uuid = T2.uuid
            WHERE T0.is_deleted = 0 AND T1.lang_code = '$lang_code' AND T0.hospital_uuid = '$hospital_uuid' AND T0.package LIKE '%$filter%' ORDER BY $column $order";
        } else {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.`hospital_package_id`,
            T0.`uuid`,
            T0.`hospital_uuid`,
            T0.package,
            T0.created_at,
            T0.package_title,
            T1.uuid AS lang_uuid,
            T1.lang_code,
            T1.language,
            T2.hospital_name,
            T2.hospital_code
            FROM (SELECT @no:= 0) AS no, hospital_package_table T0 
            LEFT JOIN lang_table T1 ON T0.lang_uuid = T1.uuid
            LEFT JOIN hospital_table T2 ON T0.hospital_uuid = T2.uuid
            WHERE T0.is_deleted = 0 AND T1.lang_code = '$lang_code' AND T0.hospital_uuid = '$hospital_uuid' ORDER BY $column $order";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPackageByHospitalPackageUuid($hospital_package_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS number, 
        T0.`hospital_package_id`,
        T0.`uuid`,
        T0.`hospital_uuid`,
        T0.package,
        T0.created_at,
        T0.package_title,
        T1.uuid AS lang_uuid,
        T1.lang_code,
        T1.language
        FROM (SELECT @no:= 0) AS no, hospital_package_table T0 
        LEFT JOIN lang_table T1 ON T0.lang_uuid = T1.uuid
        WHERE T0.is_deleted = 0 AND T0.uuid = '$hospital_package_uuid'";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
