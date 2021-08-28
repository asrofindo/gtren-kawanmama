<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUpgrade extends Migration
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
			'user_id' => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
			],
			'code'      	=> ['type' => 'text', 'null' => true],
			'status_request'=> ['type' => 'varchar', 'constraint'     => 255],
			'photo'=> ['type' => 'text', 'null' => true],
			'type'          => ['type' => 'varchar', 'constraint' => 255],
			'created_at'    => ['type' => 'datetime', 'null'      => true],
			'updated_at'    => ['type' => 'datetime', 'null'      => true],
			'deleted_at'    => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->createTable('upgrades', true);
	}

	public function down()
	{
		$this->forge->dropTable('upgrades', true);
	}
}
