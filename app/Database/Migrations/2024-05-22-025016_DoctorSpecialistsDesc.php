<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorSpecialistsDesc extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_specialist_desc_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'specialist_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'specialist_desc' => [
                'type' => 'VARCHAR',
                'constraint' => 256,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'lang_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('doctor_specialist_desc_id', true);
        $this->forge->createTable('doctor_specialist_desc_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_specialist_desc_table');
    }
}
