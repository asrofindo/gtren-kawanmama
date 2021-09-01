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
			"pembeli_id" 			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			"product_distributor_id" 		=> ['type' => 'int', 'constraint' => 11, 'null' => true],
			"address_id" 		=> ['type' => 'int', 'constraint' => 11, 'null' => true],
			"status_pemesanan" 	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"affiliate_link" 	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"komisi_affiliate" 	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"komisi_stockist" 	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"total" 			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"kurir" 			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"ongkir" 			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"jumlah_product"  			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true], 
			'created_at'        => ['type' => 'datetime', 'null'      => true],
			'updated_at'        => ['type' => 'datetime', 'null'      => true],
			'deleted_at'        => ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('pembeli_id', 'users', 'id', 'CASCADE', 'NO ACTION');

        $this->forge->createTable('transaksi', true);
	}

	public function down()
	{
		$this->forge->dropTable('transaksi', true);
	}
}
