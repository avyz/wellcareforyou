<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorEducation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_education_id' => [
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
            'doctor_education_desc' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'doctor_education_location' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'doctor_education_year' => [
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
        $this->forge->addKey('doctor_education_id', true);
        $this->forge->createTable('doctor_education_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_education_table');
    }
}
