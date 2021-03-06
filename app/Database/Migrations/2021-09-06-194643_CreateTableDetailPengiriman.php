<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class createTableDetailPengiriman extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],

			'pengiriman_id'       		=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'cart_id'					=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'created_at'           		=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('detailpengiriman', true);
	}

	public function down()
	{
		$this->forge->dropTable('detailpengiriman', true);
	}
}
