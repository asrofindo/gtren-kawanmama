<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldAdminCommissioin extends Migration
{
	public function up()
	{
		$fields = [
	        'admin_commission' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'affiliate_commission'
			]
		];
		$this->forge->addColumn('detailtransaksi', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('detailtransaksi', 'admin_commission');
	}
}
