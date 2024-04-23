<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HospitalBranchAddress extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hospital_branch_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'hospital_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'hospital_location_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'hospital_address' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'hospital_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'hospital_map_location' => [
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
        $this->forge->addKey('hospital_branch_id', true);
        $this->forge->createTable('hospital_branch_address_table');
    }

    public function down()
    {
        $this->forge->dropTable('hospital_branch_address_table');
    }
}
