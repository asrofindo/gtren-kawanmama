<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldStatusDana extends Migration
{
	public function up()
	{
		$fields = [
	        'status_dana' => [
				'type'  => 'text',
				'constraint'  => 255,
				'after' => 'total'
			]
		];
		$this->forge->addColumn('pendapatan', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('pendapatan', 'status');
	}
}
