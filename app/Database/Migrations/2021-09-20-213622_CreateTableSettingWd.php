<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSettingWd extends Migration
{
	public function up()
	{
		$this->forge->addField([
		'id'                   => [
			'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
		],
		'group_id'					=> ['type' => 'int', 'constraint' => 11, 'null' => true],
		'minimal'					=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
		'created_at'           		=> ['type' => 'datetime', 'null'      => true],
		'updated_at'           		=> ['type' => 'datetime', 'null'      => true],
		'deleted_at'           		=> ['type' => 'datetime', 'null'      => true],
	]);

	$this->forge->addKey('id',true);

	$this->forge->createTable('setting_wd', true);
	}
	public function down()
	{
		$this->forge->dropTable('setting_wd', true);
	}
}
