<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \CodeIgniter\I18n\Time;

class UniqueCodeSeeder extends Seeder
{
	public function run()
	{

		for($i = 2; $i < 20; $i++){			
			$data = [
				'code' => $i * 323,
				'username' => 'imron'
			];
			$this->db->table('uniquecode')->insert($data);
		};
	}
}
