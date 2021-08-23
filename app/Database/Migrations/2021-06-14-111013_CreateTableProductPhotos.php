<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProductPhotos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'product_id' => ['type' => 'int', 'constraint' => 11, 'null' => true, 'unsigned' => true],
			'photo'      => ['type' => 'text', 'null' => true],
			'created_at' => ['type' => 'datetime', 'null' => true],
			'updated_at' => ['type' => 'datetime', 'null' => true],
			'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('product_photos', true);
	}

	public function down()
	{
		$this->forge->dropTable('product_photos', true);
	}
}
