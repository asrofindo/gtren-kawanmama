<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\ProductModel;

class Category extends Entity
{
	protected $datamap = [];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [];

	public function getProduct(Array $value)
	{
		$product = new ProductModel();

		$data = $product->whereIn('categories', $value)->findAll(20);
		return $data;
	}
}

