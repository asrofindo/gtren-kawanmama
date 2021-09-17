<?php

namespace App\Controllers;
use App\Models\CartItemModel;
use App\Models\ProductModel;

use App\Controllers\BaseController;

class Cart extends BaseController
{
	public function __construct(){
		$this->cart = new CartItemModel();
		$this->product = new ProductModel();
	}

	public function save($id=null)
	{
		if (user()==null) {
			return redirect()->to('/login');		}
		
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
		$transaksi = $this->cart->select('user_id, product_id, distributor_id, total, amount, id, status')
		->where('user_id', user()->id)
		->where('product_id', $product_id)
		->where('status', null)
		->where('distributor_id', $distributor_id)->find();

		if(count($transaksi) > 0){
			if ($id!=null) {
				$data=["affiliate_link" => '/src/'.$id];
			}
			$data = [
				"id" => $transaksi[0]->id,
				"product_id" => $product_id,
				"affiliate_link" => '/src/'.$id,
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
		else {
			$this->cart->save($data);

			return redirect()->to('/cart');
		} 

		return redirect()->to('/cart');
		
	}

	public function delete($id)
	{	
		$this->cart->delete($id);
		return redirect()->back();
	}

	public function add($id)
	{
		$transaksi = $this->cart->find($id);
		
		$data = $this->cart->join('distributor', 'distributor.id = distributor_id')
		->join('product_distributor', 'product_distributor.product_id = cart_item.product_id')
		->where('cart_item.id', $id)->find();

		if($data[0]->amount == $data[0]->jumlah){
			return redirect()->back();
		}
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
		
		$data['carts'] = $this->cart->select('*')
		->where('cart_item.user_id', user()->id)->where('cart_item.status ', null)
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
