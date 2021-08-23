<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugFieldProduct extends Migration
{
	public function up()
	{
		$fields = [
	        'slug' => [
				'type'  => 'text',
				'null'  => true,
				'after' => 'description'
	        ],
		];
		$this->forge->addColumn('products', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('products', 'slug');
	}
}
