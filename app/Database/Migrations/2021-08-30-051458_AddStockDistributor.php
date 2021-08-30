<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStockDistributor extends Migration
{
	public function up()
	{
		$fields = [
	        'jumlah' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'product_id'
	        ]
		];
		$this->forge->addColumn('product_distributor', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('product_distributor', 'jumlah');
	}
}
