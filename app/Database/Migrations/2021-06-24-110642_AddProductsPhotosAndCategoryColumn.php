<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProductsPhotosAndCategoryColumn extends Migration
{
	public function up()
	{
		$fields = [
        	'photos' => [
				'type'  => 'text',
				'null'  => true,
				'after' => 'slug'
	        ],
	        'categories' => [
				'type'  => 'text',
				'null'  => true,
				'after' => 'description'
	        ],
		];
		$this->forge->addColumn('products', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('products', ['photos', 'categories']);
	}
}
