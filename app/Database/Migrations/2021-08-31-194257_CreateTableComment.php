<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableComment extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => [
				'type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true
			],
			'product_id'       		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'user_id'       		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'comment'				=> ['type' => 'text', 'constraint' => 255, 'null' => true],
			'rating'					=> ['type' => 'int', 'constraint' => 11, 'null' => true],
			'created_at'           	=> ['type' => 'datetime', 'null'      => true],
			'updated_at'           	=> ['type' => 'datetime', 'null'      => true],
			'deleted_at'           	=> ['type' => 'datetime', 'null'      => true],
        ]);
		
		$this->forge->addKey('id', true);



        $this->forge->createTable('comments', true);
	}

	public function down()
	{
		
	}
}
