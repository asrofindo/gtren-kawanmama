<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUpgrade extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'user_id' => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'code'      	=> ['type' => 'text', 'null' => true],
			'status_request'=> ['type' => 'varchar', 'constraint'     => 255],
			'photo'=> ['type' => 'text', 'null' => true],
			'type'          => ['type' => 'varchar', 'constraint' => 255],
			'total'          => ['type' => 'varchar', 'constraint' => 255],
			'bill'          => ['type' => 'varchar', 'constraint' => 255],
			'created_at'    => ['type' => 'datetime', 'null'      => true],
			'updated_at'    => ['type' => 'datetime', 'null'      => true],
			'deleted_at'    => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('user_id', true);
        $this->forge->createTable('upgrades', true);
	}

	public function down()
	{
		$this->forge->dropTable('upgrades', true);
	}
}
