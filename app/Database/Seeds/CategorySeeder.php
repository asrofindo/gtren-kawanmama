<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \CodeIgniter\I18n\Time;

class CategorySeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
				'category'        => 'Clothes',
				'description' => 'Men Clothes',
				'created_at' => Time::now('Asia/Jakarta')
			],
			[
				'category'        => 'Foods',
				'description' => 'Delicious Food',
				'created_at' => Time::now('Asia/Jakarta')
			],
			[
				'category'        => 'Electronics',
				'description' => 'Electronic',
				'created_at' => Time::now('Asia/Jakarta')
			],
			[
				'category'        => 'Sports',
				'description' => 'Sport',
				'created_at' => Time::now('Asia/Jakarta')
			]
		];
		$this->db->table('categories')->insertBatch($data);
	}
}
