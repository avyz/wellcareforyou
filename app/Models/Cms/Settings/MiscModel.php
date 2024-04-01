<?php

namespace App\Models\Cms\Settings;

use CodeIgniter\Model;

class MiscModel extends Model
{
    public static function dataMisc($lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code) {
            $query = "SELECT @no:=@no+1 AS number, 
            `misc_id`,
            `uuid`,
            misc_logo,
            misc_logo_white,
            misc_emergency_number,
            misc_fulltime_number,
            footer_desc,
            work_days,
            work_time,
            `address`,
            `email`,
            `facebook_link`,
            `twitter_link`,
            `instagram_link`,
            `created_at`,
            `updated_at`,
            lang_code FROM setting_misc_table, (SELECT @no:= 0) AS no 
            WHERE lang_code = '$lang_code'";
        } else {
            $query = "SELECT @no:=@no+1 AS number, 
            `misc_id`,
            `uuid`,
            misc_logo,
            misc_logo_white,
            misc_emergency_number,
            misc_fulltime_number,
            footer_desc,
            work_days,
            work_time,
            `address`,
            `email`,
            `facebook_link`,
            `twitter_link`,
            `instagram_link`,
            `created_at`,
            `updated_at`,
            lang_code FROM setting_misc_table, (SELECT @no:= 0) AS no 
            WHERE lang_code = (SELECT a.lang_code FROM lang_table a WHERE a.is_lang_default = 1)";
        }

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
