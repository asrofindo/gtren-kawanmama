<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKonfirmasi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],
			'user_id'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'transaksi_id'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'date'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'total'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'bill'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'keterangan'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'           		=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id',true);

        $this->forge->createTable('konfirmasi', true);
	}

	public function down()
	{
		$this->forge->dropTable('konfirmasi', true);
	}
}
