<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class PeopleSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            $data = [
                'nama' => $faker->name,
                'alamat'    => $faker->address,
                // conversi timestamp $faker ke datetime mysql
                'created_at' => Time::createFromTimestamp($faker->unixTime())
            ];
            // Using Query Builder
            $this->db->table('people')->insert($data);
        }

        // Simple Queries
        // $this->db->query('INSERT INTO people (nama, alamat) VALUES(:nama:, :alamat:)', $data);

    }
}
