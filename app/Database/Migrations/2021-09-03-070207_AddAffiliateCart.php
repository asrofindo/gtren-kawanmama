<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAffiliateCart extends Migration
{
	public function up()
	{
		$fields = [
	        'affiliate_link' => [
				'type'  => 'varchar',
				'constraint'  => 255,
				'after' => 'user_id'
	        ]
		];
		$this->forge->addColumn('cart_item', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('cart_item', 'affiliate_link');

	}
}
