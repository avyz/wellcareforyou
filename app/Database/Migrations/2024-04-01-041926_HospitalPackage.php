<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HospitalPackage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hospital_package_id' => [
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
            'package' => [
                'type' => 'TEXT',
            ],
            'package_title' => [
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
            ],
            'lang_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ]
        ]);
        $this->forge->addKey('hospital_package_id', true);
        $this->forge->createTable('hospital_package_table');
    }

    public function down()
    {
        $this->forge->dropTable('hospital_package_table');
    }
}
