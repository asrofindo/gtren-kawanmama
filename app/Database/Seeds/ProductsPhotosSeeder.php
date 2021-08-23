<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \CodeIgniter\I18n\Time;

class ProductsPhotosSeeder extends Seeder
{
	public function run()
	{
		for ($i=0; $i < 150; $i++) { 
			$data = [
				'product_id' => rand(1, 100),
				'photo'      => static::faker()->imageUrl(640, 480, 'product', true),
				'created_at' => Time::now('Asia/Jakarta')
			];
			$this->db->table('product_photos')->insert($data);
		}
	}
}
