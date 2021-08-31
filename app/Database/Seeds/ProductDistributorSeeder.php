<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductDistributorSeeder extends Seeder
{
	public function run()
	{
		$data = [
			'distributor_id' => 1,
			'product_id' => 1
		];
        $this->db->table('product_distributor')->insert($data);
	}
}
