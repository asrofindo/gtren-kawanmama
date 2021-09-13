<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLevelDistributor extends Migration
{
	public function up()
	{
		$fields = [
	        'level' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'locate'
			]
		];
		$this->forge->addColumn('distributor', $fields);	}

	public function down()
	{
		$this->forge->dropColumn('distributor', 'level');
	}
}
