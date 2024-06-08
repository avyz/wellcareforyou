<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PageGrid extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'page_grid_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'page_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'paragraph' => [
                'type' => 'TEXT',
            ],
            'urutan' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
        ]);
        $this->forge->addKey('page_grid_id', true);
        $this->forge->createTable('page_grid_table');
    }

    public function down()
    {
        $this->forge->dropTable('page_grid_table');
    }
}
