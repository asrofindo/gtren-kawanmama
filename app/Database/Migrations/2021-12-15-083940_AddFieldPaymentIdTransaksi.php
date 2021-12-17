<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldPaymentIdTransaksi extends Migration
{
	public function up()
	{
		$fields = [
	        'payment_id' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'total'
			]
		];
		$this->forge->addColumn('transaksi', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('transaksi', 'payment_id');
	}
}
