<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldDistributorId extends Migration
{
	public function up()
	{
		$fields = [
	        'distributor_id' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'cart_id'
			]
		];
		$this->forge->addColumn('detailtransaksi', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('detailtransaksi', 'distributor_id');
	}
}
