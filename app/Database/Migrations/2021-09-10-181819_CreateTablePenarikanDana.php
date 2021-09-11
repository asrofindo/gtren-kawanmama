<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class createTablePenarikanDana extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],

			'user_id'       		=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'jumlah_wd'					=> ['type' => 'int', 'constraint' => 255, 'null' => true],
			'status'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'           		=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
        ]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('penarikan_dana', true);
	}

	public function down()
	{
		$this->forge->dropTable('penarikan_dana', true);
	}
}
