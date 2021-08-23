<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameProductCategoriesTable extends Migration
{
	public function up()
	{
		$this->forge->renameTable('product_categories', 'categories');
	}

	public function down()
	{
		$this->forge->renameTable('categories', 'product_categories');
	}
}
