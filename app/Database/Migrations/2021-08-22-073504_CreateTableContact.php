<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableContact extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id' => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'photo'       => ['type' => 'text', 'constraint' => null],
			'address'       => ['type' => 'varchar', 'constraint'     => 255],
			'phone' => ['type' => 'varchar', 'constraint' => 255],
			'created_at'  => ['type' => 'datetime', 'null'      => true],
			'updated_at'  => ['type' => 'datetime', 'null'      => true],
			'deleted_at'  => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('contact', true);
	}

	public function down()
	{
		$this->forge->dropTable('contact', true);
	}
}
