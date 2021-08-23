<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProducts extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],
			'category_id'          => ['type' => 'int', 'constraint' => 11, 'null' => true, 'unsigned' => true],
			'name'                 => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'description'          => ['type' => 'text', 'null' => true],
			'fixed_price'          => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
			'sell_price'           => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
			'affiliate_commission' => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
			'stockist_commission'  => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
			'created_at'           => ['type' => 'datetime', 'null'      => true],
			'updated_at'           => ['type' => 'datetime', 'null'      => true],
			'deleted_at'           => ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('category_id', 'product_categories', 'id', 'CASCADE', 'NO ACTION');

        $this->forge->createTable('products', true);
	}

	public function down()
	{
		$this->forge->dropTable('products', true);
	}
}
