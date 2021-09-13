<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldAlamatTransaksi extends Migration
{
	public function up()
	{
		$fields = [
	        'alamat' => [
				'type'  => 'text',
				'constraint'  => 255,
				'after' => 'total'
			]
		];
		$this->forge->addColumn('transaksi', $fields);	}

	public function down()
	{
		$this->forge->dropColumn('transaksi', 'alamat');
	}
}
