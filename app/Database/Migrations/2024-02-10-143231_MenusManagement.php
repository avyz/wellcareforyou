<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenusManagement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_management_id' => [
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
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
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
            'search' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'download' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'created_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('menu_management_id', true);
        $this->forge->createTable('menu_management_table');
    }

    public function down()
    {
        $this->forge->dropTable('menu_management_table');
    }
}
