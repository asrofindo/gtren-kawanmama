<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\CategoryModel;

class ProductDistributor extends Entity
{
	protected $datamap = [];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [
		'photos'     => 'csv',
		'categories' => 'csv',
	];

	public function getCategory(Array $value)
	{
		$category = new CategoryModel();

		$data = $category->find($value);
		return $data;
	}
}
