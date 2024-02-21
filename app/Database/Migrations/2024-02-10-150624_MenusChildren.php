<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenusChildren extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_children_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'menu_children_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'menu_children_icon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'menu_children_url' => [
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
        ]);
        $this->forge->addKey('menu_children_id', true);
        $this->forge->createTable('menu_children_table');
    }

    public function down()
    {
        $this->forge->dropTable('menu_children_table');
    }
}
