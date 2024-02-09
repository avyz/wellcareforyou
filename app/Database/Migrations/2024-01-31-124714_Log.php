<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Log extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'log_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => '11',
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
        $this->forge->addKey('log_id', true);
        $this->forge->createTable('log_table');
    }

    public function down()
    {
        $this->forge->dropTable('log_table');
    }
}
