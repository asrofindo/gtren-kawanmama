<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldTotalToTableBill extends Migration
{
	public function up()
	{
		$fields = [
	        'total' => [
				'type'  => 'int',
				'constraint'  => 255,
				'after' => 'owner'
			]
		];
		$this->forge->addColumn('bills', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('bills', 'total');
	}
}
