<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNameContact extends Migration
{
	public function up()
	{
		$fields = [
	        'name' => [
				'type'  => 'text',
				'null'  => true,
				'after' => 'photo'
	        ],
		];

		$this->forge->addColumn('contact', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('contact', 'name');
	}
}
