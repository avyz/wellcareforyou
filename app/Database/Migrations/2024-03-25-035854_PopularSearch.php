<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PopularSearch extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'popular_search_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'navbar_management_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'navbar_management_children_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'navbar_management_children_url' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'lang_code' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => 1,
            ]
        ]);
        $this->forge->addKey('popular_search_id', true);
        $this->forge->createTable('popular_search_table');
    }

    public function down()
    {
        $this->forge->dropTable('popular_search_table');
    }
}
