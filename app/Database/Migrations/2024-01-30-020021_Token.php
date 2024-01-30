<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Token extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'token_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'otp' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'time_expired' => [
                'type' => 'datetime',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('token_id', true);
        $this->forge->createTable('token_table');
    }

    public function down()
    {
        $this->forge->dropTable('token_table');
    }
}
