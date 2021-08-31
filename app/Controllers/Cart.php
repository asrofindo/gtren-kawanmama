<?php

namespace App\Controllers;
use App\Models\CartItemModel;

use App\Controllers\BaseController;

class Cart extends BaseController
{
	public function __construct(){
		$this->cart = new CartItemModel();
	}

	public function save()
	{
		$product_id = $this->request->getPost('product_id');
		$distributor_id = $this->request->getPost('distributor_id');
		$amount = $this->request->getPost('amount');
		$price = $this->request->getPost('price_sell');
		$total = $amount * $price;
		

		$data = [
			"product_id" => $product_id,
			"distributor_id" => $distributor_id,
			"user_id" => user()->id,
			"amount" => $amount,
			"total" => $total
		];
		$transaksi = $this->cart->select('user_id, product_id, distributor_id, total, amount, id')
		->where('user_id', user()->id)
		->where('product_id', $product_id)
		->where('distributor_id', $distributor_id)->find();


		// $this->cart->select('transaksi.cart_id, transaksi.status');
		// $transaksi = $this->cart->join('transaksi.cart_id', 'id = transaksi.cart_id', 'left')->where('status', 'pending');

		if(count($transaksi) == 0){
			$this->cart->save($data);
			return redirect()->to('/cart');
		} else {
			$data = [
				"id" => $transaksi[0]->id,
				"product_id" => $product_id,
				"distributor_id" => $distributor_id,
				"user_id" => user()->id,
				"amount" => $amount + $transaksi[0]->amount,
				"total" => $total * ($amount + $transaksi[0]->amount)
			];
			
			$this->cart->where('user_id', user()->id)
			->where('product_id', $product_id)
			->where('distributor_id', $distributor_id)->replace($data);
		}
		
	}
}
