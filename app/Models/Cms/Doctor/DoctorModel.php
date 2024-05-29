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

    public static function dataDoctorComplete($filter, $column, $order, $fullData)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT @no:=@no+1 AS number,
        T0.doctor_name,
        T0.doctor_phone,
        (SELECT GROUP_CONCAT(b.language SEPARATOR '|') FROM doctor_language_list_table a 
         LEFT JOIN lang_table b ON b.lang_code = a.lang_code 
         WHERE a.doctor_uuid = T0.uuid) AS doctor_language,
         (SELECT GROUP_CONCAT(d.specialist_name SEPARATOR '|') FROM doctor_specialist_list_table c 
         LEFT JOIN doctor_specialist_table d ON d.uuid = c.doctor_specialist_uuid 
         WHERE c.doctor_uuid = T0.uuid) AS doctor_specialist,
         (SELECT GROUP_CONCAT(f.hospital_name SEPARATOR '|') FROM doctor_hospital_table e 
         LEFT JOIN hospital_table f ON f.uuid = e.hospital_uuid 
         WHERE e.doctor_uuid = T0.uuid) AS doctor_hospital,
        T0.doctor_address,
        T0.doctor_gender,
        T0.created_at FROM (SELECT @no:= 0) AS no, doctor_table T0
        WHERE T0.is_deleted = 0 ORDER BY $column $order";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_table WHERE uuid = '$doctor_id' AND is_deleted = 0";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorBiographyById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_biography_list_table WHERE doctor_uuid = '$doctor_id'";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorBiographyByIdAndLangCode($doctor_id, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_biography_list_table WHERE doctor_uuid = '$doctor_id' AND lang_code = '$lang_code'";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorEducationById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_education_table WHERE doctor_uuid = '$doctor_id' ORDER BY doctor_education_year ASC";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorEducationByIdAndEducation($doctor_id, $doctor_education)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_education_table WHERE doctor_uuid = '$doctor_id' AND doctor_education = '$doctor_education'";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorEmploymentById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_employment_table WHERE doctor_uuid = '$doctor_id' ORDER BY doctor_employment_year ASC";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorEmploymentByIdAndEmployment($doctor_id, $doctor_employment)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_employment_table WHERE doctor_uuid = '$doctor_id' AND doctor_employment = '$doctor_employment'";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorHospitalById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT T0.*, T1.hospital_name FROM doctor_hospital_table T0 
        LEFT JOIN hospital_table T1 ON T0.hospital_uuid = T1.uuid
        WHERE T0.doctor_uuid = '$doctor_id' AND T1.is_deleted = 0 ORDER BY T1.hospital_name ASC";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorHospitalByIdAndHospitalId($doctor_id, $hospital_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT T0.*, T1.hospital_name FROM doctor_hospital_table T0 
        LEFT JOIN hospital_table T1 ON T0.hospital_uuid = T1.uuid
        WHERE T0.doctor_uuid = '$doctor_id' AND T0.hospital_uuid = '$hospital_id' AND T1.is_deleted = 0 ORDER BY T1.hospital_name ASC";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorLanguageById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT T0.*, T1.language FROM doctor_language_list_table T0
        LEFT JOIN lang_table T1 ON T0.lang_code = T1.lang_code
        WHERE T0.doctor_uuid = '$doctor_id' AND T1.is_active = 1 ORDER BY T1.language ASC";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorLanguageByIdAndLangCode($doctor_id, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT T0.*, T1.language FROM doctor_language_list_table T0
        LEFT JOIN lang_table T1 ON T0.lang_code = T1.lang_code
        WHERE T0.doctor_uuid = '$doctor_id' AND T0.lang_code = '$lang_code' AND T1.is_active = 1 ORDER BY T1.language ASC";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialistListById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT T0.*, T1.specialist_name FROM doctor_specialist_list_table T0
        LEFT JOIN doctor_specialist_table T1 ON T0.doctor_specialist_uuid = T1.uuid
        WHERE T0.doctor_uuid = '$doctor_id' AND T1.is_active = 1 ORDER BY T1.specialist_name ASC";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorSpecialistByIdAndSpecialistId($doctor_id, $doctor_specialist_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT T0.*, T1.specialist_name FROM doctor_specialist_list_table T0
        LEFT JOIN doctor_specialist_table T1 ON T0.doctor_specialist_uuid = T1.uuid
        WHERE T0.doctor_uuid = '$doctor_id' AND T0.doctor_specialist_uuid = '$doctor_specialist_id' AND T1.is_active = 1 ORDER BY T1.specialist_name ASC";
        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataDoctorWorktimeById($doctor_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM doctor_worktime_table WHERE doctor_uuid = '$doctor_id'";
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
