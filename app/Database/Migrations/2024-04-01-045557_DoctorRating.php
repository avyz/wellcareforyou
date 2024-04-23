<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorRating extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_rating_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'doctor_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'user_uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'rating' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 256,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('doctor_rating_id', true);
        $this->forge->createTable('doctor_rating_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_rating_table');
    }
}
