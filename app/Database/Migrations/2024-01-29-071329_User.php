<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'auth_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'ktp' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
            ],
            'passport' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_depan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_belakang' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
            ],
            'gol_darah' => [
                'type' => 'VARCHAR',
                'constraint' => '5',
            ],
            'tgl_lahir' => [
                'type' => 'DATETIME',
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'alamat_domisili' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'provinsi_id_domisili' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kota_id_domisili' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kec_id_domisili' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kel_id_domisili' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kode_pos_domisili' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'provinsi_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kota_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kec_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kel_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'kode_pos' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'data_complete' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('user_table');
    }

    public function down()
    {
        $this->forge->dropTable('user_table');
    }
}
