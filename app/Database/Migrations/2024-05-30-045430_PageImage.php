<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PageImage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'page_image_id' => [
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'page_image' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'page_image_urutan' => [
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
        $this->forge->addKey('page_image_id', true);
        $this->forge->createTable('page_image_table');
    }

    public function down()
    {
        $this->forge->dropTable('page_image_table');
    }
}
