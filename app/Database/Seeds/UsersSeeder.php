<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
	public function run()
	{
		$passwordHash = password_hash('default', PASSWORD_DEFAULT);

		 $data = [
            [
                'name' => 'Alice Admin',
                'email' => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'name' => 'Tom Teacher',
                'email' => 'teacher@example.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role' => 'teacher',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'name' => 'Sam Student',
                'email' => 'student@example.com',
                'password' => password_hash('student123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => null,
                'updated_at' => null,
            ],
        ];

		$this->db->table('users')->insertBatch($data);
	}
}


