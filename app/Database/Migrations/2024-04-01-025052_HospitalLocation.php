<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HospitalLocation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hospital_location_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'country_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'hospital_location_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'hospital_location_name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
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
        $this->forge->addKey('hospital_location_id', true);
        $this->forge->createTable('hospital_location_table');
    }

    public function down()
    {
        $this->forge->dropTable('hospital_location_table');
    }
}
