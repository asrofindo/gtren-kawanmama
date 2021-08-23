<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Libraries\Slug;
use App\Models\CategoryModel;

class Product extends Entity
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

	public function setSlug(String $value)
	{
		$slug = new Slug();
		$this->attributes['slug'] = $slug->slugify($value);
		return $this;
	}

	public function getCategory(Array $value)
	{
		$category = new CategoryModel();

		$data = $category->find($value);
		return $data;
	}
}
