<?php

namespace App\Models;

use CodeIgniter\Model;

class BillModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'bills';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'App\Entities\Bill';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['bank_name', 'bank_number', 'owner', 'total'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	protected $validationRules      = [];
	protected $validationMessages   = [];

	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
	// Validation
	// protected $validationRules      = [
	// 	'bank_name'   => 'required',
	// 	'bank_number' => 'required|is_unique[bills.bank_number, id, {id}]|max_length[16]|min_length[16]',
	// 	'owner'       => 'required'
	// ];
	// protected $validationMessages   = [
	// 	'bank_name' => [
	// 		'required'  => 'Nama Bank Harus Diisi'
	// 	],
	// 	'bank_number' => [
	// 		'required'   => 'Nomor Rekening Harus Diisi',
	// 		'is_unique'  => 'Nomor Rekening Sudah Ada',
	// 		'max_length' => 'Nomor Rekening Tidak Boleh Lebih Dari 16',
	// 		'min_length' => 'Nomor Rekening Tidak Boleh Kurang Dari 16'
	// 	],
	// 	'owner' => [
	// 		'required'  => 'Nama Pemilik Rekening Harus Diisi'
	// 	],
	// ];

	
}
