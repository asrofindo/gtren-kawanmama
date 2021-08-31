<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTransaksi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],

			'cart_id'           	=> ['type' => 'int', 'constraint' => 11, 'null' => true, 'unsigned' => true],
			'status'       			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'           	=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           	=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           	=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('cart_id', 'cart_item', 'id', 'CASCADE', 'NO ACTION');

        $this->forge->createTable('transaksi', true);
	}

	public function down()
	{
		$this->forge->dropTable('transaksi', true);
	}
}
