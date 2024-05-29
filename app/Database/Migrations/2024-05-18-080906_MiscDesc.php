<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiscDesc extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'misc_desc_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'misc_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'footer_desc' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
            ],
            'work_days' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'lang_code' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ]
        ]);
        $this->forge->addKey('misc_desc_id', true);
        $this->forge->createTable('setting_misc_desc_table');
    }

    public function down()
    {
        $this->forge->dropTable('setting_misc_desc_table');
    }
}
