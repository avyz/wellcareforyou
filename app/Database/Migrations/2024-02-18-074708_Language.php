<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Language extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lang_id' => [
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
                'constraint' => '25',
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'lang_icon' => [
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
            'is_lang_default' => [
                'type' => 'INT',
                'constraint' => '1'
            ]
        ]);
        $this->forge->addKey('lang_id', true);
        $this->forge->createTable('lang_table');
    }

    public function down()
    {
        $this->forge->dropTable('lang_table');
    }
}
