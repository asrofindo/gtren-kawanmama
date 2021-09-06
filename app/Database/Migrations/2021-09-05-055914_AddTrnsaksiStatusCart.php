<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTrnsaksiStatusCart extends Migration
{
	public function up()
	{
		$fields = [
	        'transaksi_id' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'user_id'
			],
			'status' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'total'
	        ]
		];
		$this->forge->addColumn('cart_item', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('cart_item', 'transaksi_id , status');
	}
}
