<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAddress extends Migration
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
			'provinsi'      => ['type' => 'text', 'constraint' => null],
			'kabupaten'     => ['type' => 'varchar', 'constraint'     => 255],
			'kecamatan'     => ['type' => 'varchar', 'constraint'     => 255],
			'kode_pos'      => ['type' => 'varchar', 'constraint' => 255],
			'detail_alamat' => ['type' => 'varchar', 'constraint' => 255],
			'type'          => ['type' => 'varchar', 'constraint' => 255],
			'created_at'    => ['type' => 'datetime', 'null'      => true],
			'updated_at'    => ['type' => 'datetime', 'null'      => true],
			'deleted_at'    => ['type' => 'datetime', 'null'      => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->createTable('address', true);
	}

	public function down()
	{
		$this->forge->dropTable('address', true);
	}
}
