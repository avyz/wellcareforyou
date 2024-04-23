<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorEmployment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_employment_id' => [
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
            'doctor_employment_desc' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'doctor_employment_year' => [
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
        $this->forge->addKey('doctor_employment_id', true);
        $this->forge->createTable('doctor_employment_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_employment_table');
    }
}
