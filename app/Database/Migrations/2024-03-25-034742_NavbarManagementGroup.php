<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NavbarManagementGroup extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'navbar_management_group_id' => [
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
            'navbar_management_group_name' => [
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
            ],
            'navbar_management_whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'navbar_management_meta_desc' => [
                'type' => 'TEXT'
            ]
        ]);
        $this->forge->addKey('navbar_management_group_id', true);
        $this->forge->createTable('page_navbar_group_table');
    }

    public function down()
    {
        $this->forge->dropTable('page_navbar_group_table');
    }
}
