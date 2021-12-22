<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldPageToPayments extends Migration
{
	public function up()
	{
		$fields = [
	        'page' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'channel_code'
			]
		];
		$this->forge->addColumn('payments', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('payments', 'page');
	}
}
