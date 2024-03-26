<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Auth extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'auth_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'is_verified' => [
                'type' => 'INT',
                'constraint' => '1'
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => '1'
            ],
            'login_type' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ],
            'is_agree' => [
                'type' => 'INT',
                'constraint' => '1'
            ],
            'is_lockscreen' => [
                'type' => 'INT',
                'constraint' => '1'
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('auth_id', true);
        $this->forge->createTable('auth_table');
    }

    public function down()
    {
        $this->forge->dropTable('auth_table');
    }
}
