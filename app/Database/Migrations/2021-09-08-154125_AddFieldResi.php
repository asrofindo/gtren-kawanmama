<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldResi extends Migration
{
	public function up()
	{
		$fields = [
	        'resi' => [
				'type'  => 'text',
				'constraint'  => 255,
				'after' => 'affiliate_commission'
			]
		];
		$this->forge->addColumn('detailtransaksi', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('detailtransaksi', 'resi');
	}
}
