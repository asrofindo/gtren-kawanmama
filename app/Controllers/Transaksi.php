<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\CartItemModel;
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
	public function __construct()
	{
		$this->model = new TransaksiModel();
		$this->cart = new CartItemModel();
	}
	public function save()
	{
		$id = user()->id;
		$data = $this->cart->select("products.name as product_name, products.sell_price, products.fixed_price, products.affiliate_commission, products.stockist_commission")
		->join('users', 'users.id = cart_item.id', 'left')
		->where('cart_item.user_id', $id)
		->join('products', 'products.id = cart_item.product_id', 'left')->find();

		dd($data);
	}
}
