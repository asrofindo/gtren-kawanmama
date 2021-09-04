<?php

namespace App\Controllers;
use App\Models\CartItemModel;

use App\Controllers\BaseController;

class Cart extends BaseController
{
	public function __construct(){
		$this->cart = new CartItemModel();
	}

	public function save($id=null)
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
		if ($id!=null) {
			$data['affiliate_link']='/src/'.$id;
		}
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
				"total" => $transaksi[0]->total * ($amount + $transaksi[0]->amount)
			];
			$this->cart->where('user_id', user()->id)
			->where('product_id', $product_id)
			->where('distributor_id', $distributor_id)->replace($data);
			return redirect()->to('/cart');
		}
		
	}

	public function delete($id)
	{	

		$this->cart->delete($id);
		return redirect()->back();
	}

	public function add($id)
	{
		$transaksi = $this->cart->find($id);

		$data = [
			"id" => $id,
			"user_id" => user()->id,
			"amount" => $transaksi->amount  + 1,
			"total" => $transaksi->total + ($transaksi->total / $transaksi->amount)
		];
		$this->cart->save($data);
		return redirect()->back();
	}

	public function substruct($id)
	{
		$transaksi = $this->cart->find($id);
		if($transaksi->amount == 1){
			return redirect()->back();	
		}
		$data = [
			"id" => $transaksi->id,
			"user_id" => user()->id,
			"amount" => $transaksi->amount  - 1,
			"total" => $transaksi->total - ($transaksi->total / $transaksi->amount)
		];

		$this->cart->save($data);
		return redirect()->back();
	}

	public function delete_all()
	{	
		$data['carts_id'] = [];
		$data['carts'] = $this->cart->select('products.id as p_id, address.id as a_id, users.id as u_id, cart_item.id as id, products.name, products.photos, products.sell_price, users.username, address.kecamatan, address.kabupaten, address.provinsi, product_id, products.photos, amount, total, distributor_id')
		->join('products', 'products.id = product_id', 'left')
		->join('users', 'users.id = distributor_id', 'left')
		->join('address', 'address.user_id = distributor_id', 'left')->where('type', 'distributor')
		->where('cart_item.user_id', user()->id)
		->find();
		if(count($data['carts']) > 0){			
			for($i = 0; count($data['carts']) > $i; $i++){			
				array_push($data['carts_id'], $data['carts'][$i]->id);
			}

			$this->cart->whereIn('id', $data['carts_id'])->delete();
			return redirect()->back();
		}

		return redirect()->back();
	}
}
