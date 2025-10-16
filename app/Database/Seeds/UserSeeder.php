<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->emptyTable();

        $data = [
            [
                'name'     => 'Bina',
                'email'    => 'bina@example.com',
                'role'     => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
            [
                'name'     => 'Jim',
                'email'    => 'jim@example.com',
                'role'     => 'instructor',
                'password' => password_hash('teach123', PASSWORD_DEFAULT),
            ],
            [
                'name'     => 'Jenifer',
                'email'    => 'jenifer@example.com',
                'role'     => 'student',
                'password' => password_hash('stud123', PASSWORD_DEFAULT),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
