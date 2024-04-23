<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DoctorWorkTime extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'doctor_worktime_id' => [
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
            'worktime_day' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'worktime_start_time' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'worktime_end_time' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ],
            'is_closed' => [
                'type' => 'INT',
                'constraint' => 1,
            ]
        ]);
        $this->forge->addKey('doctor_worktime_id', true);
        $this->forge->createTable('doctor_worktime_table');
    }

    public function down()
    {
        $this->forge->dropTable('doctor_worktime_table');
    }
}
