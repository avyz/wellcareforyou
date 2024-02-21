<?php

namespace App\Models\Cms\Users;

use CodeIgniter\Model;

class UsersModel extends Model
{
    public static function dataUsers()
    {
        $instance = new static();
        $db = $instance->getDb();

        $query = "SELECT
        T0.email,
        T0.password,
        T1.role,
        T2.*,
        T0.is_verified,
        T0.is_active,
        T0.login_type
        FROM auth_table T0 
        LEFT JOIN role_table T1 ON T1.role_id = T0.role_id
        LEFT JOIN user_table T2 ON T2.auth_id = T0.auth_id
        WHERE T0.is_active = 1";

        $result = $db->query($query)->getResultArray();

        return $result;
    }

    public static function dataUsersByEmail($email)
    {
        $instance = new static();
        $db = $instance->getDb();

        $query = "SELECT
        T0.email,
        T0.password,
        T1.role,
        T1.is_master,
        T1.is_admin,
        T2.*,
        T0.is_verified,
        T0.is_active,
        T0.login_type,
        T0.is_lockscreen
        FROM auth_table T0 
        LEFT JOIN role_table T1 ON T1.role_id = T0.role_id
        LEFT JOIN user_table T2 ON T2.auth_id = T0.auth_id
        WHERE T0.email = '$email'";

        $result = $db->query($query)->getRowArray();

        return $result;
    }

    public static function dataTokenByEmail($email)
    {
        $instance = new static();
        $db = $instance->getDb();

        $query = "SELECT
        token, email, time_expired, otp FROM token_table
        WHERE email = '$email'";

        $result = $db->query($query)->getRowArray();

        return $result;
    }
}
