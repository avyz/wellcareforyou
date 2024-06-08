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
                    is_main,
                    to_page,
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
                    is_main,
                    to_page,
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
                    is_main,
                    to_page,
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
                    is_main,
                    to_page,
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
                    is_main,
                    to_page,
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
                    is_main,
                    to_page,
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
                    is_main,
                    to_page,
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
                    is_main,
                    to_page,
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

    public static function dataPageNavbarByLangCode($lang_code, $navbar_management_url)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code) {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.navbar_management_id,
            T0.uuid,
            T0.`lang_code`,
            T0.`navbar_management_name`,
            T0.navbar_management_url,
            T0.is_active,
            T0.created_at,
            T0.navbar_management_whatsapp,
            T0.navbar_management_meta_desc,
            T0.is_main,
            T0.to_page,
            T1.navbar_management_group_name
            FROM (SELECT @no:= 0) AS no, page_navbar_group_child_table A
            LEFT JOIN page_navbar_table T0 ON T0.uuid = A.navbar_management_uuid
            LEFT JOIN page_navbar_group_table T1 ON T1.uuid = A.navbar_management_group_uuid WHERE A.is_active = 1 AND T1.is_navbar = '1' AND T0.lang_code = '$lang_code' AND T0.navbar_management_url = '$navbar_management_url'";
        } else {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.navbar_management_id,
            T0.uuid,
            T0.`lang_code`,
            T0.`navbar_management_name`,
            T0.navbar_management_url,
            T0.is_active,
            T0.created_at,
            T0.navbar_management_whatsapp,
            T0.navbar_management_meta_desc,
            T0.is_main,
            T0.to_page,
            T1.navbar_management_group_name
            FROM (SELECT @no:= 0) AS no, page_navbar_group_child_table A
            LEFT JOIN page_navbar_table T0 ON T0.uuid = A.navbar_management_uuid
            LEFT JOIN page_navbar_group_table T1 ON T1.uuid = A.navbar_management_group_uuid WHERE A.is_active = 1 AND T1.is_navbar = '1' AND T0.lang_code = 'en' AND T0.navbar_management_url = '$navbar_management_url'";
        }

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataArrayPageNavbarByLangCode($lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code) {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.navbar_management_id,
            T0.uuid,
            T0.`lang_code`,
            T0.`navbar_management_name`,
            T0.navbar_management_url,
            T0.is_active,
            T0.created_at,
            T0.navbar_management_whatsapp,
            T0.navbar_management_meta_desc,
            T0.is_main,
            T0.to_page,
            T1.navbar_management_group_name
            FROM (SELECT @no:= 0) AS no, page_navbar_group_child_table A
            LEFT JOIN page_navbar_table T0 ON T0.uuid = A.navbar_management_uuid
            LEFT JOIN page_navbar_group_table T1 ON T1.uuid = A.navbar_management_group_uuid WHERE A.is_active = 1 AND T1.is_navbar = '1' AND T0.lang_code = '$lang_code'";
        } else {
            $query = "SELECT @no:=@no+1 AS number, 
            T0.navbar_management_id,
            T0.uuid,
            T0.`lang_code`,
            T0.`navbar_management_name`,
            T0.navbar_management_url,
            T0.is_active,
            T0.created_at,
            T0.navbar_management_whatsapp,
            T0.navbar_management_meta_desc,
            T0.is_main,
            T0.to_page,
            T1.navbar_management_group_name
            FROM (SELECT @no:= 0) AS no, page_navbar_group_child_table A
            LEFT JOIN page_navbar_table T0 ON T0.uuid = A.navbar_management_uuid
            LEFT JOIN page_navbar_group_table T1 ON T1.uuid = A.navbar_management_group_uuid WHERE A.is_active = 1 AND T1.is_navbar = '1' AND T0.lang_code = 'en'";
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
        is_main,
        to_page,
        navbar_management_id FROM page_navbar_table 
        WHERE `uuid` = '$uuid'";

        $result = $db->query($query)->getRowArray();


        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function cekNavbarMain($lang_code, $navbar_management_url)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT is_main FROM page_navbar_table WHERE lang_code = '$lang_code' AND navbar_management_url = '$navbar_management_url' AND is_active = 1";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Page Table By UUID
    public static function getPageTableByPageUuid($page_uuid, $section)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `page_id`,
        uuid,
        navbar_uuid,
        section,
        title,
        subtitle,
        paragraph,
        created_at,
        updated_at,
        lang_code, 
        page_image, 
        optional_title FROM page_table 
        WHERE `uuid` = '$page_uuid' AND section = '$section'";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPagesWebsiteByNavbarId($page_navbar_id, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;
        $uri = service('uri');
        if ($uri->getPath() == '/') {
            $segment_uri = '/';
        } else {
            $segment_uri = '/' . $uri->getSegment(1);
        }
        if ($page_navbar_id) {
            $query = "SELECT `page_id`,
            uuid,
            navbar_uuid,
            section,
            title,
            subtitle,
            optional_title,
            paragraph,
            created_at,
            updated_at,
            page_image,
            lang_code FROM page_table 
            WHERE `navbar_uuid` = '$page_navbar_id' AND lang_code = '$lang_code'";
        } else {
            $query = "SELECT `page_id`,
            uuid,
            navbar_uuid,
            section,
            title,
            subtitle,
            optional_title,
            paragraph,
            created_at,
            updated_at,
            page_image,
            lang_code FROM page_table 
            WHERE `navbar_uuid` = (SELECT a.uuid FROM page_navbar_table a WHERE a.navbar_management_url = '$segment_uri' AND a.lang_code = '$lang_code') AND lang_code = '$lang_code'";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPagesSectionWebsiteByNavbarId($nid, $lang_code, $section)
    {
        $instance = new static();
        $db = $instance->db;

        $uri = service('uri');
        if ($uri->getPath() == '/') {
            $segment_uri = '/';
        } else {
            $segment_uri = '/' . $uri->getSegment(1);
        }

        if ($nid) {
            $query = "SELECT `page_id`,
            uuid,
            navbar_uuid,
            section,
            title,
            optional_title,
            subtitle,
            paragraph,
            created_at,
            updated_at,
            page_image,
            lang_code FROM page_table 
            WHERE `navbar_uuid` = '$nid' AND lang_code = '$lang_code' AND section = '$section' ORDER BY section ASC";
        } else {
            $query = "SELECT `page_id`,
            uuid,
            navbar_uuid,
            section,
            title,
            optional_title,
            subtitle,
            paragraph,
            created_at,
            updated_at,
            page_image,
            lang_code FROM page_table 
            WHERE `navbar_uuid` = (SELECT a.uuid FROM page_navbar_table a WHERE a.navbar_management_url = '$segment_uri' AND a.lang_code = '$lang_code') AND lang_code = '$lang_code' AND section = '$section' ORDER BY section ASC";
        }

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPageByNavbarIdAndSection($lang_code, $section)
    {
        $instance = new static();
        $db = $instance->db;

        $uri = service('uri');
        if ($uri->getPath() == '/') {
            $segment_uri = '/';
        } else {
            $segment_uri = '/' . $uri->getSegment(1);
        }

        $query = "SELECT `page_id`,
        uuid,
        navbar_uuid,
        section,
        title,
        subtitle,
        paragraph,
        optional_title,
        created_at,
        updated_at,
        page_image,
        lang_code FROM page_table 
        WHERE `navbar_uuid` = (SELECT a.uuid FROM page_navbar_table a WHERE a.navbar_management_url = '$segment_uri' AND a.lang_code = '$lang_code') AND lang_code = '$lang_code' AND section = '$section'";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPagesButtonWebsiteByPageId($page_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `page_button_id`,
        uuid,
        page_uuid,
        button_text_one,
        button_text_two,
        button_text_three,
        button_text_four,
        button_text_five,
        created_at,
        updated_at
        FROM page_button_table 
        WHERE `page_uuid` = '$page_uuid'";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPagesGridWebsiteByPageId($page_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `page_grid_id`,
        uuid,
        page_uuid,
        `image`,
        title,
        paragraph,
        urutan,
        created_at,
        updated_at
        FROM page_grid_table 
        WHERE `page_uuid` = '$page_uuid'";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPagesGridWebsiteByPageIdAndurutan($page_uuid, $urutan)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `page_grid_id`,
        uuid,
        page_uuid,
        `image`,
        title,
        paragraph,
        urutan,
        created_at,
        updated_at
        FROM page_grid_table 
        WHERE `page_uuid` = '$page_uuid' AND `urutan` = '$urutan'";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataPagesImageWebsiteByPageId($page_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT `page_image_id`,
        uuid,
        page_uuid,
        title,
        page_image,
        page_image_urutan,
        created_at,
        updated_at
        FROM page_image_table 
        WHERE `page_uuid` = '$page_uuid'";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function cekToPage($lang_code, $to_page)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT to_page FROM page_navbar_table WHERE lang_code = '$lang_code' AND to_page = '$to_page' AND is_active = 1";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
