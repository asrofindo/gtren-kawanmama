<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCartItem extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],

			'distributor_id'        => ['type' => 'int', 'constraint' => 11, 'null' => true, 'unsigned' => true],
			'product_id'       		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'user_id'       		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'amount'				=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'total'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'           	=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           	=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           	=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);

		$this->forge->addForeignKey('distributor_id', 'distributor', 'id', 'CASCADE', 'NO ACTION');

        $this->forge->createTable('cart_item', true);
	}

	public function down()
	{
		$this->forge->dropTable('cart_item', true);
	}
}
