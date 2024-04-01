<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Misc extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'misc_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'misc_logo' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'misc_logo_white' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'misc_emergency_number' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'misc_fulltime_number' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'footer_desc' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
            ],
            'work_days' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'work_time' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'facebook_link' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'twitter_link' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'instagram_link' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
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
        $this->forge->addKey('misc_id', true);
        $this->forge->createTable('setting_misc_table');
    }

    public function down()
    {
        $this->forge->dropTable('setting_misc_table');
    }
}
