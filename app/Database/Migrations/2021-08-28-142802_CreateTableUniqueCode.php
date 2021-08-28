<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUniqueCode extends Migration
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
			'code'       => ['type' => 'text', 'constraint' => null],
			'created_at'  => ['type' => 'datetime', 'null'      => true],
			'updated_at'  => ['type' => 'datetime', 'null'      => true],
			'deleted_at'  => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('uniquecode', true);
	}

	public function down()
	{
		$this->forge->dropTable('uniquecode', true);
	}
}
