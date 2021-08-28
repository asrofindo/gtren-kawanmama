<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsedFieldUnique extends Migration
{
	public function up()
	{
		$fields = [
	        'used' => [
				'type'  => 'boolean',
				'null'  => true,
				'after' => 'code'
	        ],
		];
		$this->forge->addColumn('uniquecode', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('uniquecode', 'used');
	}
}
