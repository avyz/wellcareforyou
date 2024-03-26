<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NavbarManagement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'navbar_management_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'lang_code' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'navbar_management_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'navbar_management_url' => [
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
                'constraint' => 1,
            ]
        ]);
        $this->forge->addKey('navbar_management_id', true);
        $this->forge->createTable('page_navbar_table');
    }

    public function down()
    {
        $this->forge->dropTable('page_navbar_table');
    }
}
