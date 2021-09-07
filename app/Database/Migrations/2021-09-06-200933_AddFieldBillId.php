<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldMigration extends Migration
{
	public function up()
	{
		$fields = [
	        'bill_id' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'status_pembayaran'
			]
		];
		$this->forge->addColumn('transaksi', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('transaksi', 'bill_id');
	}
}
