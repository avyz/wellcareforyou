<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'menu_slug' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'menu_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'menu_icon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'menu_url' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
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
            ],
            'lang_code' => [
                'type' => 'VARCHAR',
                'constraint' => '25'
            ],
            'menu_number' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addKey('menu_id', true);
        $this->forge->createTable('menu_table');
    }

    public function down()
    {
        $this->forge->dropTable('menu_table');
    }
}
