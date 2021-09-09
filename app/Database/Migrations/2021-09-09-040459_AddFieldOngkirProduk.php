<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldOngkirProduk extends Migration
{
	public function up()
	{
		$fields = [
	        'ongkir_produk' => [
				'type'  => 'text',
				'constraint'  => 255,
				'after' => 'cart_id'
			]
		];
		$this->forge->addColumn('detailpengiriman', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('detailpengiriman', 'ongkir_produk');
	}
}
