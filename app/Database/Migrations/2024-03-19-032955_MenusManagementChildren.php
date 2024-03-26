<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenusManagementChildren extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_management_children_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'menu_management_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'menu_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'view' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'create' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'edit' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'delete' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'buttons_csv' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'buttons_excel' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'buttons_print' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ]
        ]);
        $this->forge->addKey('menu_management_children_id', true);
        $this->forge->createTable('menu_management_children_table');
    }

    public function down()
    {
        $this->forge->dropTable('menu_management_children_table');
    }
}
