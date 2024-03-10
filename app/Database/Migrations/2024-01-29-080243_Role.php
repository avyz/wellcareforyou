<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => '1'
            ],
            'is_master' => [
                'type' => 'INT',
                'constraint' => '1'
            ],
            'is_admin' => [
                'type' => 'INT',
                'constraint' => '1'
            ],
        ]);
        $this->forge->addKey('role_id', true);
        $this->forge->createTable('role_table');
    }

    public function down()
    {
        $this->forge->dropTable('role_table');
    }
}
