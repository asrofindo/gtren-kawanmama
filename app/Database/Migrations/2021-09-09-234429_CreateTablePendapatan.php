<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class createTablePendapatan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],

			'user_id'       		=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'masuk'					=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'keluar'					=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'total'					=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'created_at'           		=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('pendapatan', true);
	}

	public function down()
	{
		$this->forge->dropTable('pendapatan', true);
	}
}
