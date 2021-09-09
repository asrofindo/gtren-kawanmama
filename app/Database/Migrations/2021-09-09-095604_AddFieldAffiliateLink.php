<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFielAffiliateLink extends Migration
{
	public function up()
	{
		$fields = [
	        'affiliate_link' => [
				'type'  => 'text',
				'constraint'  => 255,
				'after' => 'total'
			]
		];
		$this->forge->addColumn('cart_item', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('cart_item', 'affiliate_link');
	}
}
