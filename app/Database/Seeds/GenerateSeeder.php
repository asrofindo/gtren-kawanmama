<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \CodeIgniter\I18n\Time;

class GenerateSeeder extends Seeder
{
	public function run()
	{
		$data = 
		[
				'nomor' => 1,
		];
		$this->db->table('generate')->insert($data);
	}
}
