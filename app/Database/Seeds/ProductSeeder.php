<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \CodeIgniter\I18n\Time;
use App\Libraries\Slug;

class ProductSeeder extends Seeder
{
	public function run()
	{
		$slug = new Slug();
		for ($i=0; $i < 100; $i++) { 
			$name = static::faker()->bothify('Product ##??');
			$data = [
				'name'                 => $name,
				'description'          => static::faker()->realText(200, 2),
				'categories' => implode(",", [rand(1, 5), rand(1, 5), rand(1, 5)]),
				'slug' => $slug->slugify($name),
				'photos' => implode(",", [static::faker()->imageUrl(640, 480, 'product', true), static::faker()->imageUrl(640, 480, 'product', true), static::faker()->imageUrl(640, 480, 'product', true), static::faker()->imageUrl(640, 480, 'product', true), static::faker()->imageUrl(640, 480, 'product', true)]),
				'fixed_price'          => static::faker()->numberBetween(10000, 500000),
				'sell_price'           => static::faker()->numberBetween(10000, 900000),
				'affiliate_commission' => static::faker()->numberBetween(10000, 20000),
				'stockist_commission'  => static::faker()->numberBetween(10000, 20000),
				'created_at'  => Time::now('Asia/Jakarta')
			];
			$this->db->table('products')->insert($data);
		}
	}
}
