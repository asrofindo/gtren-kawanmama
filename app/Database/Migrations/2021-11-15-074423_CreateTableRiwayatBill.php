<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRiwayatBill extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
            'bank_id'   => ['type' => 'int', 'constraint' => 11],
            'type'   => ['type' => 'varchar', 'constraint' => 255],
            'money'   => ['type' => 'varchar', 'constraint' => 255],
            'created_at'  => ['type' => 'datetime', 'null'      => true],
            'updated_at'  => ['type' => 'datetime', 'null'      => true],
            'deleted_at'  => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('riwayat_bill', true);

	}

	public function down()
	{
		$this->forge->dropTable('riwayat_bill', true);
	}
}
