<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldTotalRekening extends Migration
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
		$this->forge->addColumn('rekening', $fields);	}

	public function down()
	{
		$this->forge->dropColumn('rekening', 'total');
	}
}
