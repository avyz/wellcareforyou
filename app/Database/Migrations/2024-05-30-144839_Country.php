<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Country extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'country_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'country_code' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'country_icon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => '1'
            ]
        ]);
        $this->forge->addKey('country_id', true);
        $this->forge->createTable('country_table');
    }

    public function down()
    {
        $this->forge->dropTable('country_table');
    }
}
