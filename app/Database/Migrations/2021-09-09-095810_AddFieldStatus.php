<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldStatus extends Migration
{
	public function up()
	{
		$fields = [
	        'status' => [
				'type'  => 'text',
				'constraint'  => 255,
				'after' => 'affiliate_link'
			]
		];
		$this->forge->addColumn('cart_item', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('cart_item', 'status');
	}
}
