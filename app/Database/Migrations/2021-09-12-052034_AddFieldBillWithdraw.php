<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldBillWithdraw extends Migration
{
	public function up()
	{
		$fields = [
	        'bill_id' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'status'
			]
		];
		$this->forge->addColumn('penarikan_dana', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('penarikan_dana', 'bill_id');
	}
}
