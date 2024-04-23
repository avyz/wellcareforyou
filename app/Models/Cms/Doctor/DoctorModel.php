<?php

namespace App\Models\Cms\Doctor;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    public static function dataDoctor($filter, $column, $order, $fullData)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "SELECT @no:=@no+1 AS number, `doctor_id`,
            `uuid`,
            doctor_specialist_uuid,
            doctor_image,
            doctor_name,
            doctor_address,
            doctor_language,
            doctor_phone,
            doctor_gender,
            doctor_biography,
            created_at FROM doctor_table, (SELECT @no:= 0) AS no 
            WHERE `doctor_name` LIKE '%$filter%' ORDER BY $column $order";
        } else {
            $query = "SELECT @no:=@no+1 AS number, `doctor_id`,
            `uuid`,
            doctor_specialist_uuid,
            doctor_image,
            doctor_name,
            doctor_address,
            doctor_language,
            doctor_phone,
            doctor_gender,
            doctor_biography,
            created_at FROM doctor_table, (SELECT @no:= 0) AS no 
            WHERE is_deleted = 1 AND `doctor_name` LIKE '%$filter%' ORDER BY $column $order";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
