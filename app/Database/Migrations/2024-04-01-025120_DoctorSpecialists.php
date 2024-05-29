<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorSpecialists extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_specialist_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'specialist_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            // 'specialist_desc' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 256,
            // ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            // 'lang_code' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 50,
            // ],
            'specialist_code' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ]
        ]);
        $this->forge->addKey('doctor_specialist_id', true);
        $this->forge->createTable('doctor_specialist_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_specialist_table');
    }
}
