<?php

namespace App\Models\Cms\Settings;

use CodeIgniter\Model;

class CountryModel extends Model
{

    public static function dataCountry($filter, $column, $order, $fullData)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            if ($filter) {
                $query = "SELECT @no:=@no+1 AS number, `country`,
            `country_code`,
            country_icon,
            is_active,
            uuid,
            created_at,
            country_id FROM country_table, (SELECT @no:= 0) AS no 
            WHERE `country` LIKE '%$filter%' ORDER BY $column $order";
            } else {
                $query = "SELECT @no:=@no+1 AS number, `country`,
            `country_code`,
            country_icon,
            is_active,
            uuid,
            created_at,
            country_id FROM country_table, (SELECT @no:= 0) AS no
            ORDER BY $column $order";
            }
        } else {
            if ($filter) {
                $query = "SELECT @no:=@no+1 AS number, `country`,
            `country_code`,
            country_icon,
            is_active,
            uuid,
            created_at,
            country_id FROM country_table, (SELECT @no:= 0) AS no 
            WHERE is_active = 1 AND `country` LIKE '%$filter%' ORDER BY $column $order";
            } else {
                $query = "SELECT @no:=@no+1 AS number, `country`,
                `country_code`,
                country_icon,
                is_active,
                uuid,
                created_at,
                country_id FROM country_table, (SELECT @no:= 0) AS no 
                WHERE is_active = 1 ORDER BY $column $order";
            }
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function countryList()
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        country_id, 
        country_code, 
        `country`, 
        country_icon, 
        created_at, 
        is_active, 
        uuid
        FROM `country_table` 
        WHERE is_active = 1
        ORDER BY country_id ASC;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataCountryByCountryUuid($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `country`,
        `country_code`,
        country_icon,
        is_active,
        uuid,
        created_at,
        country_id FROM country_table 
        WHERE `uuid` = '$uuid'";

        $result = $db->query($query)->getRowArray();


        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
