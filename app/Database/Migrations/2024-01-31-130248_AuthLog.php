<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthLog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'auth_log_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'activity' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('auth_log_id', true);
        $this->forge->createTable('log_auth_table');
    }

    public function down()
    {
        $this->forge->dropTable('log_auth_table');
    }
}
