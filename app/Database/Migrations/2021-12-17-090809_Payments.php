<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'int',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'channel_code'   => ['type' => 'varchar','null' => true, 'constraint' => 255],
			'name'   => ['type' => 'varchar','null' => true, 'constraint' => 255],
			'photo'   => ['type' => 'text', 'constraint' => 255],
            'created_at'  => ['type' => 'datetime', 'null'      => true],
            'updated_at'  => ['type' => 'datetime', 'null'      => true],
            'deleted_at'  => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('payments', true);

	}

	public function down()
	{
		$this->forge->dropTable('payments', true);
	}
}
