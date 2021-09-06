<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'products';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'App\Entities\Product';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'name', 'description', 'categories',
		'slug', 'photos', 'fixed_price', 'sell_price',
		'affiliate_commission', 'stockist_commission','rating'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	protected $validationRules = [];
	protected $validationMessages = [];

	// Validation
	// protected $validationRules      = [
	// 	'name'                 => 'required|is_unique[products.name]',
	// 	'description'          => 'required',
	// 	'fixed_price'          => 'required',
	// 	'sell_price'           => 'required',
	// 	'affiliate_commission' => 'required',
	// 	'stockist_commission'  => 'required',
	// ];
	// protected $validationMessages   = [
	// 	'name' => [
	// 		'required'  => 'Nama Produk Harus Diisi',
	// 		'is_unique' => 'Nama Produk Sudah Ada'
	// 	],
	// 	'description' => [
	// 		'required' => 'Deskripsi Produk Harus Diisi'
	// 	],
	// 	'fixed_price' => [
	// 		'required' => 'Harga Tetap Harus Diisi'
	// 	],
	// 	'sell_price' => [
	// 		'required' => 'Harga Jual Harus Diisi'
	// 	],
	// 	'affiliate_commission' => [
	// 		'required' => 'Komisi Affiliate Harus Diisi'
	// 	],
	// 	'stockist_commission' => [
	// 		'required' => 'Komisi Stokis Harus Diisi'
	// 	],
	// ];
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

	public function getProductWithCategory()
	{
		$this->join('product_categories', 'product_categories.id = products.category_id');
		$query = $this->select(' products.id, products.name, products.description, products.slug, products.fixed_price, products.sell_price, products.affiliate_commission, products.stockist_commission, products.updated_at, product_categories.category');
		return $query;
	}

}
