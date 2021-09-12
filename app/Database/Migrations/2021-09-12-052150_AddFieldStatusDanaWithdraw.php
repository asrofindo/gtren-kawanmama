<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldStatusDanaWithdraw extends Migration
{
	public function up()
	{
		$fields = [
	        'status_dana' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'bill_id'
			]
		];
		$this->forge->addColumn('penarikan_dana', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('penarikan_dana', 'status_dana');
	}
}
