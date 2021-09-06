<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class createTableDetailTransaksi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],

			'transaksi_id'       		=> ['type' => 'int', 'constraint' => 11, 'null' => true, 'unsigned' => true],
			'cart_id'					=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'affiliate_commission'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'stockist_commission'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'status_barang'				=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'           		=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);

		$this->forge->addForeignKey('transaksi_id', 'transaksi', 'id', 'CASCADE', 'NO ACTION');

        $this->forge->createTable('detailtransaksi', true);
	}

	public function down()
	{
		$this->forge->dropTable('detailtransaksi', true);
	}
}
