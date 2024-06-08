<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Page extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'page_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'navbar_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'section' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'subtitle' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'paragraph' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'lang_code' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'optional_title' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'page_image' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('page_id', true);
        $this->forge->createTable('page_table');
    }

    public function down()
    {
        $this->forge->dropTable('page_table');
    }
}
