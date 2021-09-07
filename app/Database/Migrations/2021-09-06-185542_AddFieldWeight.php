<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldWeight extends Migration
{
	public function up()
	{
		$fields = [
	        'weight' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'stockist_commission'
			]
		];
		$this->forge->addColumn('products', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('products', 'weight');
	}
}
