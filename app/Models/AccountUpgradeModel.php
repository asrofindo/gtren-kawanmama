<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountUpgradeModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'account_upgrades';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['user_id', 'code', 'status'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
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

	public function getAll($id = null)
	{
		if ($id !== null) {
			$this->select('account_upgrades.id, users.username, users.email, account_upgrades.code, account_upgrades.status, users.id as id_user');
			$this->join('users', 'users.id = account_upgrades.user_id');
			$this->where('account_upgrades.id', $id);
			$data = $this->get();
			return $data->getRow();
		}
		$this->select('account_upgrades.id, users.username, users.email, account_upgrades.code, account_upgrades.status');
		$this->join('users', 'users.id = account_upgrades.user_id');
		// $this->where('account_upgrades.status', 'pending');
		$data = $this->get();
		return $data->getResult('object');
	}
}
