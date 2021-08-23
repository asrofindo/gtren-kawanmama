<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \CodeIgniter\I18n\Time;

class BillSeeder extends Seeder
{
	public function run()
	{

		$banks = ['BNI', 'BCA', 'BRI', 'MANDIRI', 'DANAMON'];

		/*
			Random String From array
			$a=array("red","green","blue","yellow","brown");
			$random_keys=array_rand($a);
			echo $a[$random_keys];
		*/


		for ($i=0; $i < 30; $i++) { 
			$rand_bank = array_rand($banks);
			$data = [
				'bank_name'   => $banks[$rand_bank],
				'bank_number' => static::faker()->randomNumber(5, true),
				'owner'       => static::faker()->name(),
				'created_at'  => Time::now('Asia/Jakarta')
			];
			$this->db->table('bills')->insert($data);
		}
	}
}
