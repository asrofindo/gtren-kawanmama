<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveCategoryIdColumnProduct extends Migration
{
	public function up()
	{
		$this->forge->dropForeignKey('products', 'products_category_id_foreign');
		$this->forge->dropColumn('products', 'category_id');
	}

	public function down()
	{
		$fileds = [
			'category_id' => ['type' => 'int', 'constraint' => 11, 'null' => true, 'unsigned' => true]
		];
		$this->forge->addForeignKey('category_id', 'product_categories', 'id', 'CASCADE', 'NO ACTION');
		$this->forge->addColumn('products', $fileds);
	}
}
