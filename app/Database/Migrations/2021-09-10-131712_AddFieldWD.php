<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldWD extends Migration
{
	public function up()
	{
		$fields = [
	        'penarikan_dana' => [
				'type'  => 'int',
				'constraint'  => 255,
				'after' => 'total'
			]
		];
		$this->forge->addColumn('pendapatan', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('pendapatan', 'penarikan_dana');
	}
}
