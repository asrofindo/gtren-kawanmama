<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableGenerate extends Migration
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
			'nomor'       => ['type' => 'int', 'constraint' => null],
			'created_at'  => ['type' => 'datetime', 'null'      => true],
			'updated_at'  => ['type' => 'datetime', 'null'      => true],
			'deleted_at'  => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('generate', true);
	}

	public function down()
	{
		$this->forge->dropTable('generate', true);
	}
}
