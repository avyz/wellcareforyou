<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorHospital extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_hospital_id' => [
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
            'hospital_uuid' => [
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
        $this->forge->addKey('doctor_hospital_id', true);
        $this->forge->createTable('doctor_hospital_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_hospital_table');
    }
}
