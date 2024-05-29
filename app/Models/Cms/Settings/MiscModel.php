<?php

namespace App\Models\Cms\Settings;

use CodeIgniter\Model;

class MiscModel extends Model
{
    public static function misc()
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT * FROM setting_misc_table";
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function miscDesc($lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code) {
            $query = "SELECT * FROM setting_misc_desc_table WHERE lang_code = '$lang_code'";
        } else {
            $query = "SELECT * FROM setting_misc_desc_table WHERE lang_code = 'en'";
        }

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMisc($lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code) {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.`misc_id`,
            T0.`uuid`,
            T0.misc_logo,
            T0.misc_logo_white,
            T0.misc_emergency_number,
            T0.misc_fulltime_number,
            T0.work_time,
            T0.`address`,
            T0.`email`,
            T0.`facebook_link`,
            T0.`twitter_link`,
            T0.`instagram_link`,
            T0.`created_at`,
            T0.`updated_at`,
            T1.footer_desc,
            T1.work_days,
            T1.lang_code 
            FROM (SELECT @no:= 0) AS no, setting_misc_table T0
            LEFT JOIN setting_misc_desc_table T1 ON T0.uuid = T1.misc_uuid
            WHERE T1.lang_code = '$lang_code'";
        } else {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.`misc_id`,
            T0.`uuid`,
            T0.misc_logo,
            T0.misc_logo_white,
            T0.misc_emergency_number,
            T0.misc_fulltime_number,
            T0.work_time,
            T0.`address`,
            T0.`email`,
            T0.`facebook_link`,
            T0.`twitter_link`,
            T0.`instagram_link`,
            T0.`created_at`,
            T0.`updated_at`,
            T1.footer_desc,
            T1.work_days,
            T1.lang_code
            FROM (SELECT @no:= 0) AS no, setting_misc_table T0
            LEFT JOIN setting_misc_desc_table T1 ON T0.uuid = T1.misc_uuid
            WHERE T1.lang_code = 'en'";
        }

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
