<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuChildrenTab extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_tab_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'menu_children_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'menu_tab_name' => [
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
            ],
        ]);
        $this->forge->addKey('menu_tab_id', true);
        $this->forge->createTable('menu_children_tab_table');
    }

    public function down()
    {
        $this->forge->dropTable('menu_children_tab_table');
    }
}
