<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
	public function run()
	{
		$this->call('AuthGroupsSeeder');
		$this->call('AdminSeeder');
		$this->call('CategorySeeder');
		$this->call('ProductSeeder');
		$this->call('ProductsPhotosSeeder');
		$this->call('UsersSeeder');
		$this->call('BillSeeder');
	}
}
