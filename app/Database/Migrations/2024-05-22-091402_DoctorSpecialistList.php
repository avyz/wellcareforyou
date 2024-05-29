<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorSpecialistList extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_specialist_list_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'doctor_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'doctor_specialist_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('doctor_specialist_list_id', true);
        $this->forge->createTable('doctor_specialist_list_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_specialist_list_table');
    }
}
