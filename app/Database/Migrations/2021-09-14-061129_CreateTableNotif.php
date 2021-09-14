<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableNotif extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],
			'name'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'phone'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'           		=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('notif', true);
	}

	public function down()
	{
		$this->forge->dropTable('notif', true);
	}
}
