<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRekening extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],
			'user_id'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'bank'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'number'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'owner'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'           		=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id',true);

        $this->forge->createTable('rekening', true);
	}

	public function down()
	{
		$this->forge->dropTable('rekening', true);
	}
}
