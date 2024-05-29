<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hospital extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hospital_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'hospital_image' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'hospital_name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'hospital_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            // 'hospital_location_uuid' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 50,
            // ],
            // 'hospital_address' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 128,
            // ],
            // 'hospital_phone' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 128,
            // ],
            // 'hospital_map_location' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => 128,
            // ],
            // 'is_center' => [
            //     'type' => 'INT',
            //     'constraint' => 1,
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
        $this->forge->addKey('hospital_id', true);
        $this->forge->createTable('hospital_table');
    }

    public function down()
    {
        $this->forge->dropTable('hospital_table');
    }
}
