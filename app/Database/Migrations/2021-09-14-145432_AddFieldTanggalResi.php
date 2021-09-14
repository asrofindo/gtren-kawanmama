<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldTanggalResi extends Migration
{
	public function up()
	{
		$fields = [
	        'tanggal_resi' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'affiliate_commission'
			]
		];
		$this->forge->addColumn('detailtransaksi', $fields);	}

	public function down()
	{
		$this->forge->dropColumn('detailtransaksi', 'tangal_resi');
	}
}
