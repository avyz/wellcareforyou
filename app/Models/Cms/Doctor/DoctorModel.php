<?php

namespace App\Models\Cms\Doctor;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    public static function dataDoctor($filter, $column, $order, $fullData)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData) {
            if ($filter) {
                $query = "SELECT @no:=@no+1 AS number, `doctor_id`,
                `uuid`,
                doctor_image,
                doctor_name,
                doctor_address,
                doctor_phone,
                doctor_gender,
                created_at FROM (SELECT @no:= 0) AS no, doctor_table 
                WHERE `doctor_name` LIKE '%$filter%' ORDER BY $column $order";
            } else {
                $query = "SELECT @no:=@no+1 AS number, `doctor_id`,
                `uuid`,
                doctor_image,
                doctor_name,
                doctor_address,
                doctor_phone,
                doctor_gender,
                created_at FROM (SELECT @no:= 0) AS no, doctor_table ORDER BY $column $order";
            }
        } else {
            if ($filter) {
                $query = "SELECT @no:=@no+1 AS number, `doctor_id`,
                `uuid`,
                doctor_image,
                doctor_name,
                doctor_address,
                doctor_phone,
                doctor_gender,
                created_at FROM (SELECT @no:= 0) AS no, doctor_table 
                WHERE is_deleted = 0 AND `doctor_name` LIKE '%$filter%' ORDER BY $column $order";
            } else {
                $query = "SELECT @no:=@no+1 AS number, `doctor_id`,
                `uuid`,
                doctor_image,
                doctor_name,
                doctor_address,
                doctor_phone,
                doctor_gender,
                created_at FROM (SELECT @no:= 0) AS no, doctor_table
                WHERE is_deleted = 0 ORDER BY $column $order";
            }
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialist($filter, $column, $orderDir, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            if ($filter) {
                $query = "SELECT @no:=@no+1 AS number, `doctor_specialist_id`,
                `uuid`,
                specialist_name,
                specialist_code,
                is_active,
                created_at FROM (SELECT @no:= 0) AS no, doctor_specialist_table
                WHERE `specialist_name` LIKE '%$filter%' ORDER BY $column $orderDir";
            } else {
                $query = "SELECT @no:=@no+1 AS number, `doctor_specialist_id`,
                `uuid`,
                specialist_name,
                specialist_code,
                is_active,
                created_at FROM (SELECT @no:= 0) AS no, doctor_specialist_table
                ORDER BY $column $orderDir";
            }
        } else {
            if ($filter) {
                $query = "SELECT @no:=@no+1 AS number, `doctor_specialist_id`,
                `uuid`,
                specialist_name,
                specialist_code,
                is_active,
                created_at FROM (SELECT @no:= 0) AS no, doctor_specialist_table
                WHERE is_active = 1 AND `specialist_name` LIKE '%$filter%' ORDER BY $column $orderDir";
            } else {
                $query = "SELECT @no:=@no+1 AS number, `doctor_specialist_id`,
                `uuid`,
                specialist_name,
                specialist_code,
                is_active,
                created_at FROM (SELECT @no:= 0) AS no, doctor_specialist_table
                WHERE is_active = 1 ORDER BY $column $orderDir";
            }
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialistWithSpecialistDesc($filter, $columnName, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.uuid, 
        T0.specialist_name, 
        T0.specialist_code, 
        T0.is_active, 
        T0.created_at, 
        T1.specialist_desc,
        T1.lang_code 
        FROM (SELECT @no:= 0) AS no, doctor_specialist_table T0 
        LEFT JOIN doctor_specialist_desc_table T1 ON T0.uuid = T1.specialist_uuid
        WHERE T0.is_active = 1 ORDER BY $columnName, `number` $order";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialistById($doctor_specialist_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_specialist_table WHERE uuid = '$doctor_specialist_id' AND is_active = 1";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialistDescById($doctor_specialist_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_specialist_desc_table WHERE specialist_uuid = '$doctor_specialist_id'";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialistDescByIdAndLangCode($doctor_specialist_id, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_specialist_desc_table WHERE specialist_uuid = '$doctor_specialist_id' AND lang_code = '$lang_code'";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialistDescBySpecialistId($doctor_specialist_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_specialist_desc_table WHERE specialist_uuid = '$doctor_specialist_id'";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
