<?php

namespace App\Models\Cms\UserManagement;

use CodeIgniter\Model;

class UserManagementModel extends Model
{
    // Data User
    public static function dataUser($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "
            SELECT
            @no:=@no+1 AS number,
            T0.user_id,
            T0.auth_id,
            T0.photo,
            T0.ktp,
            T0.passport,
            T0.nama_lengkap,
            T0.nama_depan,
            T0.nama_belakang,
            T0.jenis_kelamin,
            T0.gol_darah,
            T0.tgl_lahir,
            T0.no_hp,
            T0.alamat_domisili,
            T0.created_at,
            T0.uuid,
            T1.email,
            T1.is_verified,
            T1.login_type,
            T1.is_active as 'auth_active',
            T1.uuid as 'auth_uuid',
            T2.role,
            T2.is_admin,
            T2.is_master
            FROM (SELECT @no:= 0) AS no, `user_table` T0
            LEFT JOIN `auth_table` T1 ON T0.auth_id = T1.auth_id
            LEFT JOIN `role_table` T2 ON T1.role_id = T2.role_id
            WHERE (T0.nama_lengkap LIKE '%$filter%' OR T1.email LIKE '%$filter%') ORDER BY $column $order;";
        } else {
            $query = "
            SELECT
            @no:=@no+1 AS number,
            T0.user_id,
            T0.auth_id,
            T0.photo,
            T0.ktp,
            T0.passport,
            T0.nama_lengkap,
            T0.nama_depan,
            T0.nama_belakang,
            T0.jenis_kelamin,
            T0.gol_darah,
            T0.tgl_lahir,
            T0.no_hp,
            T0.alamat_domisili,
            T0.created_at,
            T0.uuid,
            T1.email,
            T1.is_verified,
            T1.login_type,
            T1.is_active as 'auth_active',
            T2.role,
            T2.is_admin,
            T2.is_master
            FROM (SELECT @no:= 0) AS no, `user_table` T0
            LEFT JOIN `auth_table` T1 ON T0.auth_id = T1.auth_id
            LEFT JOIN `role_table` T2 ON T1.role_id = T2.role_id
            WHERE T1.is_active = 1 AND (T0.nama_lengkap LIKE '%$filter%' OR T1.email LIKE '%$filter%') ORDER BY $column $order;";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data User By Uuid
    public static function dataUserByUuid($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
            SELECT
            T0.user_id,
            T0.auth_id,
            T0.photo,
            T0.ktp,
            T0.passport,
            T0.nama_lengkap,
            T0.nama_depan,
            T0.nama_belakang,
            T0.jenis_kelamin,
            T0.gol_darah,
            T0.tgl_lahir,
            T0.no_hp,
            T0.alamat_domisili,
            T0.created_at,
            T0.uuid,
            T1.email,
            T1.uuid as 'auth_uuid',
            T1.is_verified,
            T1.login_type,
            T1.is_active as 'auth_active',
            T2.uuid as 'role_uuid',
            T2.role,
            T2.is_admin,
            T2.is_master
            FROM `user_table` T0
            LEFT JOIN `auth_table` T1 ON T0.auth_id = T1.auth_id
            LEFT JOIN `role_table` T2 ON T1.role_id = T2.role_id
            WHERE T0.uuid = '$uuid';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Role
    public static function dataRole($filter, $column, $order, $fullData, $lang_code)
    {
        $instance = new static();
        $db = $instance->db;

        if ($fullData == true) {
            $query = "
            SELECT
            @no:=@no+1 AS number,
            role_id,
            role,
            is_admin,
            is_master,
            is_active,
            created_at,
            uuid
            FROM (SELECT @no:= 0) AS no, `role_table`
            WHERE role LIKE '%$filter%' ORDER BY $column $order;";
        } else {
            $query = "
            SELECT
            @no:=@no+1 AS number,
            role_id,
            role,
            is_admin,
            is_master,
            is_active,
            created_at,
            uuid
            FROM (SELECT @no:= 0) AS no, `role_table`
            WHERE is_active = 1 AND role LIKE '%$filter%' ORDER BY $column $order;";
        }

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Role by id
    public static function dataRoleById($role_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
            SELECT
            role_id,
            role,
            is_admin,
            is_master,
            is_active,
            created_at,
            uuid
            FROM `role_table`
            WHERE role_id = '$role_id';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Role By Uuid
    public static function dataRoleByUuid($uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
            SELECT
            role_id,
            role,
            is_admin,
            is_master,
            is_active,
            created_at,
            uuid
            FROM `role_table`
            WHERE uuid = '$uuid';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data menu management role by role id
    public static function dataResultMenuManagementRoleByUuid($filter, $column, $order, $fullData, $lang_code, $uuid = null)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
            SELECT
            @no:=@no+1 AS number,
            T0.menu_management_id,
            T0.menu_uuid as uuid,
            T0.role_uuid,
            T0.view,
            T0.create,
            T0.edit,
            T0.delete,
            T0.buttons-csv,
            T0.buttons-excel,
            T0.buttons-print,
            T0.created_at,
            T0.uuid as 'menu_management_uuid',
            T1.menu_id,
            T1.menu_name
            FROM (SELECT @no:= 0) AS no, `menu_management_table` T0
            LEFT JOIN `menu_table` T1 ON T0.menu_uuid = T1.uuid
            WHERE T1.is_active = 1 AND T1.lang_code = '$lang_code' AND T0.role_uuid = '$uuid' AND T1.menu_name LIKE '%$filter%' ORDER BY T0.menu_management_id ASC;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementRoleByUuid($lang_code = '', $role_uuid = null, $menu_uuid = null)
    {
        $instance = new static();
        $db = $instance->db;

        if ($lang_code != '') {
            $query = "SELECT
            @no:=@no+1 AS number,
            T0.menu_management_id,
            T0.menu_uuid as uuid,
            T0.role_uuid,
            T0.view,
            T0.create,
            T0.edit,
            T0.delete,
            T0.buttons_csv,
            T0.buttons_excel,
            T0.buttons_print,
            T0.created_at,
            T0.uuid as 'menu_management_uuid',
            T1.menu_id,
            T1.menu_name
            FROM (SELECT @no:= 0) AS no, `menu_management_table` T0
            LEFT JOIN `menu_table` T1 ON T0.menu_uuid = T1.uuid
            WHERE T1.is_active = 1 AND T1.lang_code = '$lang_code' AND T0.role_uuid = '$role_uuid' AND T0.menu_uuid = '$menu_uuid' ORDER BY T0.menu_management_id ASC;";
        } else {
            $query = "SELECT
            @no:=@no+1 AS number,
            T0.menu_management_id,
            T0.menu_uuid as uuid,
            T0.role_uuid,
            T0.view,
            T0.create,
            T0.edit,
            T0.delete,
            T0.buttons_csv,
            T0.buttons_excel,
            T0.buttons_print,
            T0.created_at,
            T0.uuid as 'menu_management_uuid',
            T1.menu_id,
            T1.menu_name
            FROM (SELECT @no:= 0) AS no, `menu_management_table` T0
            LEFT JOIN `menu_table` T1 ON T0.menu_uuid = T1.uuid
            WHERE T1.is_active = 1 AND T0.menu_uuid = '$menu_uuid' AND T0.role_uuid = '$role_uuid' ORDER BY T0.menu_management_id ASC;";
        }

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Management By Uuid
    public static function dataMenuManagementByMenuManagementId($management_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
            @no:=@no+1 AS number,
            T0.menu_management_id,
            T0.menu_uuid as uuid,
            T0.role_uuid,
            T0.view,
            T0.create,
            T0.edit,
            T0.delete,
            T0.buttons_csv,
            T0.buttons_excel,
            T0.buttons_print,
            T0.created_at,
            T0.uuid as 'menu_management_uuid',
            T1.menu_id,
            T1.menu_name
            FROM (SELECT @no:= 0) AS no, `menu_management_table` T0
            LEFT JOIN `menu_table` T1 ON T0.menu_uuid = T1.uuid
            WHERE T1.is_active = 1 AND T0.menu_management_id = '$management_id' ORDER BY T0.menu_management_id ASC;";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data management menu role child by role id and menu_uuid
    public static function dataResultMenuManagementRoleChildByMenuUuid($menu_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
            @no:=@no+1 AS number,
            T0.menu_management_children_id,
            T0.menu_children_uuid,
            T0.menu_uuid,
            T0.view,
            T0.create,
            T0.edit,
            T0.delete,
            T0.buttons_csv,
            T0.buttons_excel,
            T0.buttons_print,
            T0.created_at,
            T0.uuid as menu_management_children_uuid
            FROM (SELECT @no:= 0) AS no,
            `menu_management_children_table` T0
            LEFT JOIN menu_children_table T1 ON T1.uuid = T0.menu_children_uuid
            WHERE T1.is_active = 1 AND T0.menu_uuid = '$menu_uuid';";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementRoleChildByMenuUuid($menu_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_management_children_id,
        T0.menu_children_uuid,
        T0.menu_uuid,
        T0.menu_management_uuid,
        T0.view,
        T0.create,
        T0.edit,
        T0.delete,
        T0.buttons_csv,
        T0.buttons_excel,
        T0.buttons_print,
        T0.created_at,
        T0.uuid as menu_management_children_uuid
        FROM (SELECT @no:= 0) AS no,
        `menu_management_children_table` T0
        LEFT JOIN menu_children_table T1 ON T1.uuid = T0.menu_children_uuid
        WHERE T1.is_active = 1 AND T0.menu_uuid = '$menu_uuid';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementRoleChildByMenuChildrenUuid($menu_children_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_management_children_id,
        T0.menu_children_uuid,
        T0.menu_uuid,
        T0.view,
        T0.create,
        T0.edit,
        T0.delete,
        T0.buttons_csv,
        T0.buttons_excel,
        T0.buttons_print,
        T0.created_at,
        T0.uuid as menu_management_children_uuid
        FROM (SELECT @no:= 0) AS no,
        `menu_management_children_table` T0
        LEFT JOIN menu_children_table T1 ON T1.uuid = T0.menu_children_uuid
        WHERE T1.is_active = 1 AND T0.menu_children_uuid = '$menu_children_uuid';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementRoleChildByMenuManagementUuid($menu_children_uuid, $menu_management_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_management_children_id,
        T0.menu_children_uuid,
        T0.menu_uuid,
        T0.view,
        T0.create,
        T0.edit,
        T0.delete,
        T0.buttons_csv,
        T0.buttons_excel,
        T0.buttons_print,
        T0.created_at,
        T0.menu_management_uuid,
        T0.uuid as menu_management_children_uuid
        FROM (SELECT @no:= 0) AS no,
        `menu_management_children_table` T0
        LEFT JOIN menu_children_table T1 ON T1.uuid = T0.menu_children_uuid
        WHERE T1.is_active = 1 AND T0.menu_management_uuid = '$menu_management_uuid' AND T0.menu_children_uuid = '$menu_children_uuid';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementChildByMenuManagementChildrenId($menu_management_children_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_management_children_id,
        T0.menu_children_uuid,
        T0.menu_uuid,
        T0.view,
        T0.create,
        T0.edit,
        T0.delete,
        T0.buttons_csv,
        T0.buttons_excel,
        T0.buttons_print,
        T0.created_at,
        T0.uuid as menu_management_children_uuid
        FROM (SELECT @no:= 0) AS no,
        `menu_management_children_table` T0
        LEFT JOIN menu_children_table T1 ON T1.uuid = T0.menu_children_uuid
        WHERE T1.is_active = 1 AND T0.menu_management_children_id = '$menu_management_children_id';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementRoleChildTabByMenuChildrenUuid($menu_children_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_management_children_tab_id,
        T0.menu_children_uuid,
        T0.menu_tab_uuid,
        T0.view,
        T0.create,
        T0.edit,
        T0.delete,
        T0.buttons_csv,
        T0.buttons_excel,
        T0.buttons_print,
        T0.created_at,
        T0.uuid as menu_management_children_tab_uuid
        FROM (SELECT @no:= 0) AS no,
        `menu_management_children_tab_table` T0
        LEFT JOIN menu_children_tab_table T1 ON T1.uuid = T0.menu_tab_uuid
        WHERE T1.is_active = 1 AND T0.menu_children_uuid = '$menu_children_uuid';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementRoleChildTabByMenuTabUuid($menu_tab_uuid, $menu_management_children_uuid)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_management_children_tab_id,
        T0.menu_children_uuid,
        T0.menu_tab_uuid,
        T0.view,
        T0.create,
        T0.edit,
        T0.delete,
        T0.buttons_csv,
        T0.buttons_excel,
        T0.buttons_print,
        T0.created_at,
        T0.uuid as menu_management_children_tab_uuid,
        T0.menu_management_children_uuid
        FROM (SELECT @no:= 0) AS no,
        `menu_management_children_tab_table` T0
        LEFT JOIN menu_children_tab_table T1 ON T1.uuid = T0.menu_tab_uuid
        WHERE T1.is_active = 1 AND T0.menu_tab_uuid = '$menu_tab_uuid' AND T0.menu_management_children_uuid = '$menu_management_children_uuid';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function dataMenuManagementChildTabByMenuManagementChildrenTabId($menu_management_children_tab_id)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "SELECT
        @no:=@no+1 AS number,
        T0.menu_management_children_tab_id,
        T0.menu_children_uuid,
        T0.menu_tab_uuid,
        T0.view,
        T0.create,
        T0.edit,
        T0.delete,
        T0.buttons_csv,
        T0.buttons_excel,
        T0.buttons_print,
        T0.created_at,
        T0.uuid as menu_management_children_tab_uuid
        FROM (SELECT @no:= 0) AS no,
        `menu_management_children_tab_table` T0
        LEFT JOIN menu_children_tab_table T1 ON T1.uuid = T0.menu_tab_uuid
        WHERE T1.is_active = 1 AND T0.menu_management_children_tab_id = '$menu_management_children_tab_id';";

        $result = $db->query($query)->getRowArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Log
    public static function dataLogUser($filter, $column, $order, $fullData, $lang_code, $date_start = null, $date_end = null)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
            SELECT
            @no:=@no+1 AS number,
            T0.log_id,
            T0.user_id,
            T0.role_id,
            T0.activity,
            T0.description,
            T0.created_at,
            T2.email,
            T3.role
            FROM (SELECT @no:= 0) AS no, `log_table` T0
            LEFT JOIN `user_table` T1 ON T0.user_id = T1.user_id
            LEFT JOIN `auth_table` T2 ON T1.auth_id = T2.auth_id
            LEFT JOIN `role_table` T3 ON T2.role_id = T3.role_id
            WHERE T2.email LIKE '%$filter%' AND T0.created_at BETWEEN '$date_start' AND '$date_end' ORDER BY $column DESC;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    // Data Log Auth
    public static function dataLogAuth($filter, $column, $order, $fullData, $lang_code, $date_start = null, $date_end = null)
    {
        $instance = new static();
        $db = $instance->db;

        $query = "
            SELECT
            @no:=@no+1 AS number,
            auth_log_id,
            email,
            activity,
            description,
            created_at
            FROM (SELECT @no:= 0) AS no, `log_auth_table`
            WHERE email LIKE '%$filter%' AND created_at BETWEEN '$date_start' AND '$date_end' ORDER BY $column DESC;";

        $result = $db->query($query)->getResultArray();

        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
