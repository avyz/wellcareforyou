<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PageButton extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'page_button_id' => [
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
            'button_text_one' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
            ],
            'button_text_two' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
            ],
            'button_text_three' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
            ],
            'button_text_four' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
            ],
            'button_text_five' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
        ]);
        $this->forge->addKey('page_button_id', true);
        $this->forge->createTable('page_button_table');
    }

    public function down()
    {
        $this->forge->dropTable('page_button_table');
    }
}
