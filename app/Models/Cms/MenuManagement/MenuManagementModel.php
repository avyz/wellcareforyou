<?php

namespace App\Models\Cms\MenuManagement;

use CodeIgniter\Model;

class MenuManagementModel extends Model
{

    // Data Menu
    // Admin
    public static function dataMenu($filter = '', $column = '', $order = '', $fullData = null, $lang_code = '')
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            if ($lang_code) {
                if ($filter) {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = '$lang_code' AND (menu_name LIKE '%$filter%' OR menu_slug LIKE '%$filter%') ORDER BY $column $order;";
                } else {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = '$lang_code' ORDER BY $column $order;";
                }
            } else {
                if ($filter) {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = 'en' AND menu_name LIKE '%$filter%' OR menu_slug LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = 'en' ORDER BY $column $order;";
                }
            }
        } else {
            if ($lang_code) {
                if ($filter) {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = '$lang_code' AND is_active = 1 AND (menu_name LIKE '%$filter%' OR menu_slug LIKE '%$filter%') ORDER BY $column $order;";
                } else {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = '$lang_code' AND is_active = 1 ORDER BY $column $order;";
                }
            } else {
                if ($filter) {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = 'en' AND is_active = 1 AND (menu_name LIKE '%$filter%' OR menu_slug LIKE '%$filter%') ORDER BY $column $order;";
                } else {
                    $query = "
                    SELECT
                    @no:=@no+1 AS number,
                    menu_id,
                    menu_slug,
                    menu_name,
                    menu_icon,
                    menu_url,
                    created_at,
                    updated_at,
                    is_active,
                    uuid,
                    menu_number
                    FROM `menu_table`, (SELECT @no:= 0) AS no WHERE lang_code = 'en' AND is_active = 1 ORDER BY $column $order;";
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

    // User
    public static function dataMenuUser($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "
            SELECT
            @no:=@no+1 AS number,
            menu_id,
            menu_slug,
            menu_name,
            menu_icon,
            menu_url,
            created_at,
            updated_at,
            is_active,
            uuid
            FROM `menu_user_table`, (SELECT @no:= 0) AS no WHERE lang_code = '$lang_code' AND (menu_name LIKE '%$filter%' OR menu_slug LIKE '%$filter%') ORDER BY $column $order;";
        } else {
            $query = "
            SELECT
            @no:=@no+1 AS number,
            menu_id,
            menu_slug,
            menu_name,
            menu_icon,
            menu_url,
            created_at,
            updated_at,
            is_active,
            uuid
            FROM `menu_user_table`, (SELECT @no:= 0) AS no WHERE lang_code = '$lang_code' AND is_active = 1 AND (menu_name LIKE '%$filter%' OR menu_slug LIKE '%$filter%') ORDER BY $column $order;";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data menu by uuid
    // Admin
    public static function dataMenuByMenuId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
        SELECT
        @no:=@no+1 AS number,
        menu_id,
        menu_slug,
        menu_name,
        menu_icon,
        menu_url,
        created_at,
        updated_at,
        is_active,
        uuid,
        lang_code,
        menu_number
        FROM `menu_table`, (SELECT @no:= 0) AS no WHERE menu_id=(SELECT a.menu_id FROM menu_table a WHERE a.uuid = '$uuid') ORDER BY menu_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataMenuUserByMenuId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
        SELECT
        @no:=@no+1 AS number,
        menu_id,
        menu_slug,
        menu_name,
        menu_icon,
        menu_url,
        created_at,
        updated_at,
        is_active,
        uuid
        FROM `menu_user_table`, (SELECT @no:= 0) AS no WHERE menu_id=(SELECT a.menu_id FROM menu_user_table a WHERE a.uuid = '$uuid') ORDER BY menu_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Array menu by uuid
    // Admin
    public static function dataMenuResultByMenuId($uuid, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
        SELECT
        @no:=@no+1 AS number,
        menu_id,
        menu_slug,
        menu_name,
        menu_icon,
        menu_url,
        created_at,
        updated_at,
        is_active,
        uuid
        FROM `menu_table`, (SELECT @no:= 0) AS no WHERE is_active = 1 AND menu_id=(SELECT a.menu_id FROM menu_table a WHERE a.uuid = '$uuid') AND lang_code = '$lang_code' ORDER BY menu_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataMenuUserResultByMenuId($uuid, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
        SELECT
        @no:=@no+1 AS number,
        menu_id,
        menu_slug,
        menu_name,
        menu_icon,
        menu_url,
        created_at,
        updated_at,
        is_active,
        uuid
        FROM `menu_user_table`, (SELECT @no:= 0) AS no WHERE menu_id=(SELECT a.menu_id FROM menu_user_table a WHERE a.uuid = '$uuid') AND lang_code = '$lang_code' ORDER BY menu_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Submenu
    // Admin
    public static function dataSubmenu($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            if ($lang_code) {
                if ($filter) {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = '$lang_code' AND T0.menu_children_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = '$lang_code' ORDER BY $column $order;";
                }
            } else {
                if ($filter) {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = 'en' AND T0.menu_children_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = 'en' ORDER BY $column $order;";
                }
            }
        } else {
            if ($lang_code) {
                if ($filter) {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = '$lang_code' AND T0.is_active = 1 AND T0.menu_children_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = '$lang_code' AND T0.is_active = 1 ORDER BY $column $order;";
                }
            } else {
                if ($filter) {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = 'en' AND T0.is_active = 1 AND T0.menu_children_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT 
                    @no:=@no+1 AS number,
                    T0.menu_children_id,
                    T0.menu_id,
                    T0.menu_children_name,
                    T0.menu_children_icon,
                    T0.menu_children_url,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_children_uuid',
                    T1.menu_name,
                    T1.lang_code,
                    T1.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
                    LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = 'en' AND T0.is_active = 1 ORDER BY $column $order;";
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

    // User
    public static function dataUserSubmenu($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_table` T0
        LEFT JOIN menu_user_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = '$lang_code' AND T0.menu_children_name LIKE '%$filter%' ORDER BY $column $order;";
        } else {
            $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_table` T0
        LEFT JOIN menu_user_table T1 ON T1.menu_id = T0.menu_id WHERE T1.lang_code = '$lang_code' AND T0.is_active = 1 AND T0.menu_children_name LIKE '%$filter%' ORDER BY $column $order;";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data submenu by menu id

    // Admin
    public static function dataResultSubmenuByMenuId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
        LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T0.is_active = 1 AND T0.menu_id = (SELECT a.menu_id FROM menu_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataResultSubmenuByMenuUuid($filter, $column, $order, $fullData, $menu_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
        LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T0.is_active = 1 AND T0.menu_id = (SELECT a.menu_id FROM menu_table a WHERE a.uuid = '$menu_uuid') AND T0.menu_children_name LIKE '%$filter%' ORDER BY $column $order;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataUserResultSubmenuByMenuId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_table` T0
        LEFT JOIN menu_user_table T1 ON T1.menu_id = T0.menu_id WHERE T0.menu_id = (SELECT a.menu_id FROM menu_user_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Admin
    public static function dataSubmenuByMenuId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
        LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T1.uuid = '$uuid' ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataUserSubmenuByMenuId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_table` T0
        LEFT JOIN menu_user_table T1 ON T1.menu_id = T0.menu_id WHERE T1.uuid = '$uuid' ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data submenu array by menu id
    // Admin
    public static function dataResultSubmenuByMenuChildrenId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
        LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T0.is_active = 1 AND T0.menu_children_id=(SELECT a.menu_children_id FROM menu_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataUserResultSubmenuByMenuChildrenId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_table` T0
        LEFT JOIN menu_user_table T1 ON T1.menu_id = T0.menu_id WHERE T0.menu_children_id=(SELECT a.menu_children_id FROM menu_user_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Submenu by uuid
    // Admin
    public static function dataSubmenuByMenuChildrenId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.lang_code,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_children_table` T0
        LEFT JOIN menu_table T1 ON T1.menu_id = T0.menu_id WHERE T0.menu_children_id=(SELECT a.menu_children_id FROM menu_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataUserSubmenuByMenuChildrenId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        @no:=@no+1 AS number,
        T0.menu_children_id,
        T0.menu_id,
        T0.menu_children_name,
        T0.menu_children_icon,
        T0.menu_children_url,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_children_uuid',
        T1.menu_name,
        T1.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_table` T0
        LEFT JOIN menu_user_table T1 ON T1.menu_id = T0.menu_id WHERE T0.menu_children_id=(SELECT a.menu_children_id FROM menu_user_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_children_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Tab
    // Admin
    public static function dataTabMenu($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            if ($lang_code) {
                if ($filter) {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = '$lang_code' AND T0.menu_tab_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = '$lang_code' ORDER BY $column $order;";
                }
            } else {
                if ($filter) {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = 'en' AND T0.menu_tab_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = 'en' ORDER BY $column $order;";
                }
            }
        } else {
            if ($lang_code) {
                if ($filter) {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = '$lang_code' AND T0.is_active = 1 AND T0.menu_tab_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = '$lang_code' AND T0.is_active = 1 ORDER BY $column $order;";
                }
            } else {
                if ($filter) {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = 'en' AND T0.menu_tab_name LIKE '%$filter%' ORDER BY $column $order;";
                } else {
                    $query = "SELECT
                    @no:=@no+1 AS number,
                    T0.menu_tab_id,
                    T0.menu_children_id,
                    T0.menu_tab_name,
                    T0.created_at,
                    T0.is_active,
                    T0.uuid as 'menu_tab_uuid',
                    T1.menu_children_name,
                    T1.uuid as 'menu_children_uuid',
                    T1.menu_id,
                    T2.menu_name,
                    T2.uuid as 'menu_uuid'
                    FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
                    LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
                    LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = 'en' AND T0.is_active = 1 ORDER BY $column $order;";
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

    // User
    public static function dataUserTabMenu($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_tab_id,
        T0.menu_children_id,
        T0.menu_tab_name,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_tab_uuid',
        T1.menu_children_name,
        T1.uuid as 'menu_children_uuid',
        T1.menu_id,
        T2.menu_name,
        T2.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_tab_table` T0
        LEFT JOIN menu_user_children_table T1 ON T1.menu_children_id = T0.menu_children_id
        LEFT JOIN menu_user_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = '$lang_code' AND T0.menu_tab_name LIKE '%$filter%' ORDER BY $column $order;";
        } else {
            $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_tab_id,
        T0.menu_children_id,
        T0.menu_tab_name,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_tab_uuid',
        T1.menu_children_name,
        T1.uuid as 'menu_children_uuid',
        T1.menu_id,
        T2.menu_name,
        T2.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_tab_table` T0
        LEFT JOIN menu_user_children_table T1 ON T1.menu_children_id = T0.menu_children_id
        LEFT JOIN menu_user_table T2 ON T2.menu_id = T1.menu_id WHERE T2.lang_code = '$lang_code' AND T0.is_active = 1 AND T0.menu_tab_name LIKE '%$filter%' ORDER BY $column $order;";
        }
        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data tab by menu children id

    // Admin
    public static function dataResultTabMenuByMenuChildrenUuid($filter, $column, $order, $fullData, $uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_tab_id,
        T0.menu_children_id,
        T0.menu_tab_name,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_tab_uuid',
        T1.menu_children_name,
        T1.uuid as 'menu_children_uuid',
        T1.menu_id,
        T2.menu_name,
        T2.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
        LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
        LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T0.is_active = 1 AND T0.menu_children_id = (SELECT a.menu_children_id FROM menu_children_table a WHERE a.uuid = '$uuid') AND T0.menu_tab_name LIKE '%$filter%' ORDER BY $column $order;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public static function dataResultTabMenuByMenuChildrenId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_tab_id,
        T0.menu_children_id,
        T0.menu_tab_name,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_tab_uuid',
        T1.menu_children_name,
        T1.uuid as 'menu_children_uuid',
        T1.menu_id,
        T2.menu_name,
        T2.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
        LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
        LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T0.is_active = 1 AND T0.menu_children_id = (SELECT a.menu_children_id FROM menu_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_tab_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataUserResultTabMenuByMenuChildrenId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_tab_id,
        T0.menu_children_id,
        T0.menu_tab_name,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_tab_uuid',
        T1.menu_children_name,
        T1.uuid as 'menu_children_uuid',
        T1.menu_id,
        T2.menu_name,
        T2.uuid as 'menu_uuid'
        FROM (SELECT @no:= 0) AS no, `menu_user_children_tab_table` T0
        LEFT JOIN menu_user_children_table T1 ON T1.menu_children_id = T0.menu_children_id
        LEFT JOIN menu_user_table T2 ON T2.menu_id = T1.menu_id WHERE T0.menu_children_id = (SELECT a.menu_children_id FROM menu_user_children_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_tab_id;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Tab by uuid
    // Admin
    public static function dataTabMenuByMenuTabId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_tab_id,
        T0.menu_children_id,
        T0.menu_tab_name,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_tab_uuid',
        T1.menu_children_name,
        T1.uuid as 'menu_children_uuid',
        T1.menu_id,
        T2.menu_name,
        T2.uuid as 'menu_uuid',
        T2.lang_code
        FROM (SELECT @no:= 0) AS no, `menu_children_tab_table` T0
        LEFT JOIN menu_children_table T1 ON T1.menu_children_id = T0.menu_children_id
        LEFT JOIN menu_table T2 ON T2.menu_id = T1.menu_id WHERE T0.menu_tab_id=(SELECT a.menu_tab_id FROM menu_children_tab_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_tab_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // User
    public static function dataUserTabMenuByMenuTabId($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_tab_id,
        T0.menu_children_id,
        T0.menu_tab_name,
        T0.created_at,
        T0.is_active,
        T0.uuid as 'menu_tab_uuid',
        T1.menu_children_name,
        T1.uuid as 'menu_children_uuid',
        T1.menu_id,
        T2.menu_name,
        T2.uuid as 'menu_uuid',
        T2.lang_code
        FROM (SELECT @no:= 0) AS no, `menu_user_children_tab_table` T0
        LEFT JOIN menu_user_children_table T1 ON T1.menu_children_id = T0.menu_children_id
        LEFT JOIN menu_user_table T2 ON T2.menu_id = T1.menu_id WHERE T0.menu_tab_id=(SELECT a.menu_tab_id FROM menu_user_children_tab_table a WHERE a.uuid = '$uuid') ORDER BY T0.menu_tab_id;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function sidebar($role_id, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code) {
            $query = "SELECT 
        A.menu_management_id,
        A.role_uuid,
        A.view,
        A.create,
        A.edit,
        A.delete,
        A.buttons_csv,
        A.buttons_excel,
        A.buttons_print,
        T0.menu_id,
        T0.menu_slug,
        T0.menu_name,
        T0.menu_icon,
        T0.menu_url,
        T0.created_at,
        T0.updated_at,
        T0.is_active,
        A.menu_uuid,
        T0.uuid AS 'menu_uuid_parent',
        B.menu_children_uuid,
        T1.uuid AS 'menu_children_uuid_parent',
        T1.menu_children_id,
        T1.menu_id as 'menu_id_children',
        T1.menu_children_name,
        T1.menu_children_icon,
        T1.menu_children_url,
        T1.created_at as 'created_at_children_menu',
        T1.is_active as 'is_active_children_menu',
        B.view AS 'view_submenu',
        B.create AS 'create_submenu',
        B.edit AS 'edit_submenu',
        B.delete AS 'delete_submenu',
        B.buttons_csv AS 'buttons_csv_submenu',
        B.buttons_excel AS 'buttons_excel_submenu',
        B.buttons_print AS 'buttons_print_submenu',
        B.uuid AS 'menu_management_children_uuid',
        A.uuid AS 'menu_management_uuid'
        FROM menu_management_table A
        LEFT JOIN menu_table T0
        ON T0.uuid = A.menu_uuid
        LEFT JOIN menu_management_children_table B
        ON B.menu_management_uuid = A.uuid
        LEFT JOIN menu_children_table T1
        ON T1.uuid = B.menu_children_uuid
        WHERE T0.is_active = 1 AND A.role_uuid = (SELECT C.uuid FROM role_table C WHERE C.role_id = '$role_id') AND A.view = 1 AND T0.lang_code = '$lang_code' GROUP BY T1.menu_children_id ORDER BY T0.menu_number ASC;";
        } else {
            $query = "SELECT 
        A.menu_management_id,
        A.role_uuid,
        A.view,
        A.create,
        A.edit,
        A.delete,
        A.buttons_csv,
        A.buttons_excel,
        A.buttons_print,
        T0.menu_id,
        T0.menu_slug,
        T0.menu_name,
        T0.menu_icon,
        T0.menu_url,
        T0.created_at,
        T0.updated_at,
        T0.is_active,
        A.menu_uuid,
        T0.uuid AS 'menu_uuid_parent',
        B.menu_children_uuid,
        T1.uuid AS 'menu_children_uuid_parent',
        T1.menu_children_id,
        T1.menu_id as 'menu_id_children',
        T1.menu_children_name,
        T1.menu_children_icon,
        T1.menu_children_url,
        T1.created_at as 'created_at_children_menu',
        T1.is_active as 'is_active_children_menu',
        B.view AS 'view_submenu',
        B.create AS 'create_submenu',
        B.edit AS 'edit_submenu',
        B.delete AS 'delete_submenu',
        B.buttons_csv AS 'buttons_csv_submenu',
        B.buttons_excel AS 'buttons_excel_submenu',
        B.buttons_print AS 'buttons_print_submenu',
        B.uuid AS 'menu_management_children_uuid',
        A.uuid AS 'menu_management_uuid'
        FROM menu_management_table A
        LEFT JOIN menu_table T0
        ON T0.uuid = A.menu_uuid
        LEFT JOIN menu_management_children_table B
        ON B.menu_management_uuid = A.uuid
        LEFT JOIN menu_children_table T1
        ON T1.uuid = B.menu_children_uuid
        WHERE T0.is_active = 1 AND A.role_uuid = (SELECT C.uuid FROM role_table C WHERE C.role_id = '$role_id') AND A.view = 1 AND T0.lang_code = 'en' GROUP BY T1.menu_children_id ORDER BY T0.menu_number ASC;";
        }

        $result = $db->query($query)->getResultArray();

        $menu_management = [];
        foreach ($result as $r) {
            if (!isset($menu_management[$r['menu_id']])) {
                // Inisialisasi data menu jika belum ada
                $menu_management[$r['menu_id']] = [
                    'menu_id' => $r['menu_id'],
                    'view' => $r['view'],
                    'create' => $r['create'],
                    'edit' => $r['edit'],
                    'delete' => $r['delete'],
                    'buttons_csv' => $r['buttons_csv'],
                    'buttons_excel' => $r['buttons_excel'],
                    'buttons_print' => $r['buttons_print'],
                    'menu_name' => $r['menu_name'],
                    'menu_slug' => $r['menu_slug'],
                    'menu_icon' => $r['menu_icon'],
                    'menu_url' => $r['menu_url'],
                    'created_at' => $r['created_at'],
                    'updated_at' => $r['updated_at'],
                    'is_active' => $r['is_active'],
                    'sidebar' => [],
                    // 'tab' => []
                ];
            }

            // Tambahkan children sidebar atau tab
            if ($r['menu_children_id'] && $r['is_active_children_menu'] == 1 && $r['view_submenu'] == 1) {
                $menu_management[$r['menu_id']]['sidebar'][] = [
                    'menu_children_id' => $r['menu_children_id'],
                    'view' => $r['view_submenu'],
                    'create' => $r['create_submenu'],
                    'edit' => $r['edit_submenu'],
                    'delete' => $r['delete_submenu'],
                    'buttons_csv' => $r['buttons_csv_submenu'],
                    'buttons_excel' => $r['buttons_excel_submenu'],
                    'buttons_print' => $r['buttons_print_submenu'],
                    'menu_id' => $r['menu_id'],
                    'menu_children_name' => $r['menu_children_name'],
                    'menu_children_icon' => $r['menu_children_icon'],
                    'menu_children_url' => $r['menu_children_url'],
                    'created_at_children_menu' => $r['created_at_children_menu'],
                    'tab' => self::menuTabByChildrenId($r['menu_children_id'], $r['menu_management_children_uuid'])
                ];
            }
        }

        $menu_management = array_values($menu_management); // Reset index array
        return $menu_management;
    }

    public static function menuTabByChildrenId($children_id, $menu_management_children_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        if ($children_id) {
            $query = "SELECT
            T0.uuid AS 'menu_tab_uuid',
            T0.menu_tab_id,
            T0.menu_children_id as 'children_id',
            T0.menu_tab_name,
            T0.created_at as 'created_at_tab_menu',
            T0.is_active,
            T1.menu_children_id,
            T1.menu_id as 'menu_id_children',
            T1.menu_children_name,
            T1.menu_children_icon,
            T1.menu_children_url,
            T1.created_at as 'created_at_children_menu',
            B.uuid AS 'menu_management_children_uuid',
            C.view AS 'view_tab',
            C.create AS 'create_tab',
            C.edit AS 'edit_tab',
            C.delete AS 'delete_tab',
            C.buttons_csv AS 'buttons_csv_tab',
            C.buttons_excel AS 'buttons_excel_tab',
            C.buttons_print AS 'buttons_print_tab'
            FROM `menu_children_tab_table` T0
            LEFT JOIN menu_children_table T1
            ON T1.menu_children_id = T0.menu_children_id
            LEFT JOIN menu_management_children_table B
            ON B.menu_children_uuid = T1.uuid
            LEFT JOIN menu_management_children_tab_table C
            ON C.menu_management_uuid = B.menu_management_uuid AND C.menu_tab_uuid = T0.uuid
            WHERE T0.is_active = 1 AND T0.menu_children_id = $children_id AND B.uuid = '$menu_management_children_uuid' GROUP BY T0.menu_tab_id ORDER BY T0.menu_tab_id ASC;";

            $tabs = $db->query($query)->getResultArray();

            // Tab
            $tab = [];
            if ($tabs) {
                foreach ($tabs as $t) {
                    if (!isset($tab[$t['children_id']]) && $t['is_active'] == 1 && $t['view_tab'] == 1) {
                        $tab[] = [
                            'menu_tab_id' => $t['menu_tab_id'],
                            'menu_tab_uuid' => $t['menu_tab_uuid'],
                            'view' => $t['view_tab'],
                            'create' => $t['create_tab'],
                            'edit' => $t['edit_tab'],
                            'delete' => $t['delete_tab'],
                            'buttons_csv' => $t['buttons_csv_tab'],
                            'buttons_excel' => $t['buttons_excel_tab'],
                            'buttons_print' => $t['buttons_print_tab'],
                            'menu_children_id' => $t['children_id'],
                            'menu_tab_name' => $t['menu_tab_name'],
                            'created_at_tab_menu' => $t['created_at_tab_menu']
                        ];
                    }
                }
            }

            return $tab;
        } else {
            return [];
        }
    }

    public static function menuAksesBySlug($slug, $lang_code, $role_id)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code) {
            $query = "SELECT 
            A.menu_management_id,
            A.role_uuid,
            A.view,
            A.create,
            A.edit,
            A.delete,
            A.buttons_csv,
            A.buttons_excel,
            A.buttons_print,
            T0.menu_id,
            T0.menu_slug,
            T0.menu_name,
            T0.menu_icon,
            T0.menu_url,
            T0.created_at,
            T0.updated_at,
            T0.is_active,
            T0.lang_code,
            A.menu_uuid,
            T0.uuid AS 'menu_uuid_parent',
            IFNULL(B.menu_children_uuid, '') AS menu_children_uuid,
            IFNULL(T1.uuid, '') AS menu_children_uuid_parent,
            IFNULL(T1.menu_children_id, '') AS menu_children_id,
            IFNULL(T1.menu_children_name, '') AS menu_children_name,
            IFNULL(T1.menu_children_icon, '') AS menu_children_icon,
            IFNULL(T1.menu_children_url, '') AS menu_children_url,
            IFNULL(T1.created_at, '') AS created_at_children_menu,
            IFNULL(T1.is_active, '') AS is_active_children_menu,
            IFNULL(B.view, 0) AS view_submenu,
            IFNULL(B.create, 0) AS create_submenu,
            IFNULL(B.edit, 0) AS edit_submenu,
            IFNULL(B.delete, 0) AS delete_submenu,
            IFNULL(B.buttons_csv, 0) AS buttons_csv_submenu,
            IFNULL(B.buttons_excel, 0) AS buttons_excel_submenu,
            IFNULL(B.buttons_print, 0) AS buttons_print_submenu,
            IFNULL(B.uuid, '') AS menu_management_children_uuid,
            A.uuid AS menu_management_uuid
            FROM menu_management_table A
            LEFT JOIN menu_table T0
                ON T0.uuid = A.menu_uuid
            LEFT JOIN menu_management_children_table B
                ON B.menu_management_uuid = A.uuid
            LEFT JOIN menu_children_table T1
            ON T1.menu_id = T0.menu_id
            WHERE T0.is_active = 1 AND A.role_uuid = (SELECT C.uuid FROM role_table C WHERE C.role_id = '$role_id') AND A.view = 1 AND T0.menu_slug = '$slug' AND T0.lang_code = '$lang_code' GROUP BY T1.menu_children_id ORDER BY T0.menu_number ASC;";

            //     $query = "SELECT 
            // T0.menu_id,
            // T0.menu_slug,
            // T0.menu_name,
            // T0.menu_icon,
            // T0.menu_url,
            // T0.created_at,
            // T0.updated_at,
            // T0.is_active,
            // T0.lang_code,
            // T1.menu_children_id,
            // T1.menu_id as 'menu_id_children',
            // T1.menu_children_name,
            // T1.menu_children_icon,
            // T1.menu_children_url,
            // T1.created_at
            // FROM `menu_table` T0
            // LEFT JOIN menu_children_table T1
            // ON T1.menu_id = T0.menu_id WHERE T0.is_active = 1 AND T0.menu_slug = '$slug' AND T0.lang_code = '$lang_code' ORDER BY T0.menu_id ASC;";
        } else {
            $query = "SELECT 
            A.menu_management_id,
            A.role_uuid,
            A.view,
            A.create,
            A.edit,
            A.delete,
            A.buttons_csv,
            A.buttons_excel,
            A.buttons_print,
            T0.menu_id,
            T0.menu_slug,
            T0.menu_name,
            T0.menu_icon,
            T0.menu_url,
            T0.created_at,
            T0.updated_at,
            T0.is_active,
            T0.lang_code,
            A.menu_uuid,
            T0.uuid AS 'menu_uuid_parent',
            IFNULL(B.menu_children_uuid, '') AS menu_children_uuid,
            IFNULL(T1.uuid, '') AS menu_children_uuid_parent,
            IFNULL(T1.menu_children_id, '') AS menu_children_id,
            IFNULL(T1.menu_children_name, '') AS menu_children_name,
            IFNULL(T1.menu_children_icon, '') AS menu_children_icon,
            IFNULL(T1.menu_children_url, '') AS menu_children_url,
            IFNULL(T1.created_at, '') AS created_at_children_menu,
            IFNULL(T1.is_active, '') AS is_active_children_menu,
            IFNULL(B.view, 0) AS view_submenu,
            IFNULL(B.create, 0) AS create_submenu,
            IFNULL(B.edit, 0) AS edit_submenu,
            IFNULL(B.delete, 0) AS delete_submenu,
            IFNULL(B.buttons_csv, 0) AS buttons_csv_submenu,
            IFNULL(B.buttons_excel, 0) AS buttons_excel_submenu,
            IFNULL(B.buttons_print, 0) AS buttons_print_submenu,
            IFNULL(B.uuid, '') AS menu_management_children_uuid,
            A.uuid AS menu_management_uuid
            FROM menu_management_table A
            LEFT JOIN menu_table T0
                ON T0.uuid = A.menu_uuid
            LEFT JOIN menu_management_children_table B
                ON B.menu_management_uuid = A.uuid
            LEFT JOIN menu_children_table T1
            ON T1.menu_id = T0.menu_id
            WHERE T0.is_active = 1 AND A.role_uuid = (SELECT C.uuid FROM role_table C WHERE C.role_id = '$role_id') AND A.view = 1 AND T0.menu_slug = '$slug' AND T0.lang_code = 'en' GROUP BY T1.menu_children_id ORDER BY T0.menu_number ASC;";
        }

        $query_lang = "SELECT 
        T0.lang_id, 
        T0.lang_code, 
        T0.`language`, 
        T0.lang_icon, 
        T0.created_at, 
        T0.is_active, 
        T0.is_lang_default,
        T0.uuid AS 'lang_uuid'
        FROM `lang_table` T0
        WHERE T0.is_active = 1 
        AND EXISTS (SELECT a.lang_code FROM page_navbar_table a WHERE a.lang_code = T0.lang_code GROUP BY a.lang_code) 
        ORDER BY T0.lang_id ASC;";

        $result = $db->query($query)->getRowArray();
        $sidebars = $db->query($query)->getResultArray();

        $lang = $db->query($query_lang)->getResultArray();


        // Language
        $language = [];

        // Sidebar
        $uri = service('uri');
        $url = $uri->getPath();
        $sidebar = [];

        // Menu
        $menu_management = [];
        if ($result) {
            if ($lang) {
                foreach ($lang as $l) {
                    if (!isset($language[$l['lang_id']])) {
                        $language[] = [
                            'lang_id' => $l['lang_id'],
                            'lang_code' => $l['lang_code'],
                            'language' => $l['language'],
                            'lang_icon' => $l['lang_icon'],
                            'created_at' => $l['created_at'],
                            'is_active' => $l['is_active'],
                            'is_lang_default' => $l['is_lang_default'],
                            'lang_uuid' => $l['lang_uuid'],
                        ];
                    }
                }
            }
            if ($sidebars) {
                foreach ($sidebars as $s) {
                    if (!isset($sidebar[$s['menu_children_id']])) {
                        if ($url == $s['menu_children_url']) {
                            $sidebar[] = [
                                'view' => $s['view_submenu'],
                                'create' => $s['create_submenu'],
                                'edit' => $s['edit_submenu'],
                                'delete' => $s['delete_submenu'],
                                'buttons_csv' => $s['buttons_csv_submenu'],
                                'buttons_excel' => $s['buttons_excel_submenu'],
                                'buttons_print' => $s['buttons_print_submenu'],
                                'menu_children_id' => $s['menu_children_id'],
                                'menu_id' => $s['menu_id'],
                                'menu_children_uuid' => $result['menu_children_uuid'],
                                'menu_children_name' => $s['menu_children_name'],
                                'menu_children_icon' => $s['menu_children_icon'],
                                'menu_children_url' => $s['menu_children_url'],
                                'created_at' => $s['created_at'],
                                'tab' => self::menuTabByChildrenId($s['menu_children_id'], $s['menu_management_children_uuid'])
                            ];
                        }
                    }
                }
            }
            if (!isset($menu_management[$result['menu_id']])) {
                // Inisialisasi data menu jika belum ada
                $menu_management[$result['menu_id']]['language'] = $language;
                $menu_management[$result['menu_id']]['menu'] = [
                    'menu_id' => $result['menu_id'],
                    'menu_uuid' => $result['menu_uuid'],
                    'view' => $result['view'],
                    'create' => $result['create'],
                    'edit' => $result['edit'],
                    'delete' => $result['delete'],
                    'buttons_csv' => $result['buttons_csv'],
                    'buttons_excel' => $result['buttons_excel'],
                    'buttons_print' => $result['buttons_print'],
                    'menu_name' => $result['menu_name'],
                    'menu_slug' => $result['menu_slug'],
                    'menu_icon' => $result['menu_icon'],
                    'menu_url' => $result['menu_url'],
                    'created_at' => $result['created_at'],
                    'updated_at' => $result['updated_at'],
                    'is_active' => $result['is_active'],
                    'lang_code' => $result['lang_code']
                ];
                $menu_management[$result['menu_id']]['sidebar'] = $sidebar;
            }
        }

        $menu_management = array_values($menu_management); // Reset index array
        // dd($result);
        if ($menu_management) {
            return $menu_management[0];
        }

        return $menu_management;
    }

    // Breadcrumbs
    public static function breadCrumbsBySlug()
    {
        $breadcrumbs = service('uri');

        // Breadcrumbs
        $breadcrumb = [];
        if ($breadcrumbs) {
            $getSegments = $breadcrumbs->getSegments();
            // dd($breadcrumbs->getTotalSegments());
            if ($breadcrumbs->getTotalSegments() > 0) {
                $segment = $breadcrumbs->getSegment($breadcrumbs->getTotalSegments());
            } else {
                $segment = '/';
            }
            // $first_segment = self::menuAksesBySlug($breadcrumbs->getSegment(1), $lang_code)['menu'] ?? null;
            $i = 1;
            // if ($first_segment) {
            foreach ($getSegments as $b) {
                $subSegments = array_slice($getSegments, 0, $i);
                $link = implode('/', $subSegments);
                $text = str_replace('-', ' ', $b);
                $url = '/' . $link;
                $breadcrumb[] = [
                    // 'segment' => $first_segment['menu_slug'] === $breadcrumbs->getSegment($i) ? $first_segment['menu_name'] : ucwords($text),
                    'segment' => ucwords($text),
                    'url' => $segment == $text ? '#' : $url,
                    'is_active' => $i == $breadcrumbs->getTotalSegments() ? 1 : 0
                ];
                $i++;
            }
            // }
        }

        return $breadcrumb;
    }

    // Language List
    public static function languageList()
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT 
        lang_id, 
        lang_code, 
        `language`, 
        lang_icon, 
        created_at, 
        is_active, 
        is_lang_default,
        uuid
        FROM `lang_table` 
        WHERE is_active = 1
        ORDER BY lang_id ASC;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Language By Language Code
    public static function languageByLangCode($lang_code)
    {
        $instance = new static();
        $db = $instance->db;
        if ($lang_code) {
            $query = "SELECT 
        lang_id, 
        lang_code, 
        `language`, 
        lang_icon, 
        created_at, 
        is_active, 
        is_lang_default
        FROM `lang_table` 
        WHERE is_active = 1 AND lang_code = '$lang_code' ORDER BY lang_id ASC;";
        } else {
            $query = "SELECT 
        lang_id, 
        lang_code, 
        `language`, 
        lang_icon, 
        created_at, 
        is_active, 
        is_lang_default
        FROM `lang_table` 
        WHERE is_active = 1 AND is_lang_default = 1 ORDER BY lang_id ASC;";
        }

        $result = $db->query($query)->getRowArray();

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

        $query = "SELECT COUNT(menu_number) as last_number FROM menu_table WHERE is_active = 1 AND lang_code = '$lang_code'";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result['last_number'];
        } else {
            return null;
        }
    }
}
