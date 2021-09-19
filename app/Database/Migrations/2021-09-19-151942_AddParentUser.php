<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParentUser extends Migration
{
	public function up()
	{
		$fields = [
	        'parent' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'fullname'
			]
		];
		$this->forge->addColumn('users', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('users', 'parent');
	}
}
