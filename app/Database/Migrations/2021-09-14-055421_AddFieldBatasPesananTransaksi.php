<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldBatasPesanan extends Migration
{
	public function up()
	{
		$fields = [
	        'batas_pesanan' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'alamat'
			]
		];
		$this->forge->addColumn('transaksi', $fields);	}

	public function down()
	{
		$this->forge->dropColumn('transaksi', 'batas_pesanan');
	}
}
