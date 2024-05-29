<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Doctors extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            // 'doctor_specialist_uuid' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 50,
            // ],
            'doctor_image' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'doctor_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'doctor_address' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            // 'doctor_language' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 128,
            // ],
            'doctor_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'doctor_gender' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            // 'doctor_biography' => [
            //     'type' => 'TEXT',
            // ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'is_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
            ]
        ]);
        $this->forge->addKey('doctor_id', true);
        $this->forge->createTable('doctor_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_table');
    }
}
