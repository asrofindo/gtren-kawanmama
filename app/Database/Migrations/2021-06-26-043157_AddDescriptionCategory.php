<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDescriptionCategory extends Migration
{
	public function up()
	{
		$fields = [
	        'description' => [
				'type'  => 'text',
				'null'  => true,
				'after' => 'category'
	        ],
		];
		$this->forge->addColumn('categories', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('categories', 'description');
	}
}
