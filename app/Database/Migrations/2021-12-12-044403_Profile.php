<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profile extends Migration
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
            'photo'   => ['type' => 'text', 'constraint' => 255],
            'title'   => ['type' => 'varchar', 'constraint' => 255],
            'favicon'   => ['type' => 'text', 'constraint' => 255],
            'created_at'  => ['type' => 'datetime', 'null'      => true],
            'updated_at'  => ['type' => 'datetime', 'null'      => true],
            'deleted_at'  => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);

        $this->forge->createTable('profiles', true);

	}

	public function down()
	{
		$this->forge->dropTable('profiles', true);
	}
}
