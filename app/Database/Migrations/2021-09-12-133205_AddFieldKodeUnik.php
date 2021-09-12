<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldKodeUnik extends Migration
{
	public function up()
	{
		$fields = [
	        'kode_unik' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'total'
			]
		];
		$this->forge->addColumn('transaksi', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('transaksi', 'kode_unik');
	}
}
