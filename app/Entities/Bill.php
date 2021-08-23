<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Bill extends Entity
{
	protected $attributes = [
		'id'          => null,
		'bank_name'   => null,
		'bank_number' => null,
		'owner'       => null,
		'created_at'  => null,
		'updated_at'  => null,
		'deleted_at'  => null,
    ];
	protected $datamap = [
		'nama_pemilik'   => 'owner',
		'nama_bank'      => 'bank_name',
		'nomor_rekening' => 'bank_number'
	];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [];
}
