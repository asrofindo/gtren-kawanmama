<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePengiriman extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],
			"user_id" 			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			"ongkir" => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"etd" 			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			"kurir" 			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'        => ['type' => 'datetime', 'null'      => true],
			'updated_at'        => ['type' => 'datetime', 'null'      => true],
			'deleted_at'        => ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'NO ACTION');

        $this->forge->createTable('pengiriman', true);
	}

	public function down()
	{
		$this->forge->dropTable('pengiriman', true);
	}
}
