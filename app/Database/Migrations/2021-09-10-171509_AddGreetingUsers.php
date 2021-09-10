<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGreetingUsers extends Migration
{
	public function up()
	{
		$fields = [
	        'greeting' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'fullname'
			]
		];
		$this->forge->addColumn('users', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('users', 'greeting');
	}
}
