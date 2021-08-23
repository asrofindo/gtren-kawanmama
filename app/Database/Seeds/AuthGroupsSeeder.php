<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupsSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				'name'        => 'admin',
				'description' => 'admin role',
			],
			[
				'name'        => 'finance',
				'description' => 'finance role',
			],
			[
				'name'        => 'stockist',
				'description' => 'stockist role',
			],
			[
				'name'        => 'affiliate',
				'description' => 'affiliate role',
			],
			[
				'name'        => 'user',
				'description' => 'user role',
			]
		];
		$this->db->table('auth_groups')->insertBatch($data);
	}
}
