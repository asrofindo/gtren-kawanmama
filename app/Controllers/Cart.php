<?php

namespace App\Controllers;
use App\Models\CartItemModel;
use App\Models\ProductModel;
use App\Models\PengirimanModel;
use App\Models\DetailPengirimanModel;

use App\Controllers\BaseController;

class Cart extends BaseController
{
	public function __construct(){
		$this->cart = new CartItemModel();
		$this->product = new ProductModel();
		$this->pengiriman = new PengirimanModel();
		$this->detailpengiriman = new DetailPengirimanModel(); 
	}

	public function save($id=null)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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

			$data_transaksi = $this->cart->where('user_id', user()->id)
			->where('product_id', $product_id)
			->where('status', null)
			->where('distributor_id', $distributor_id)->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')->first();
			
			if($data_transaksi->pengiriman_id != null){
				$pengiriman_id = $data_transaksi->pengiriman_id;
				$this->detailpengiriman->whereIn('pengiriman_id', [$pengiriman_id])->delete();
				$this->pengiriman->delete($pengiriman_id);
			}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}


		$transaksi = $this->cart->find($id);
		
		$data = $this->cart->select('*, detailpengiriman.id as dp_id')->join('distributor', 'distributor.id = distributor_id')
		->join('product_distributor', 'product_distributor.product_id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->where('cart_item.id', $id)->find();
		if($data[0]->dp_id != null){
			$pengiriman_id = $data[0]->pengiriman_id;
			$this->detailpengiriman->whereIn('pengiriman_id', [$pengiriman_id])->delete();
			$this->pengiriman->delete($pengiriman_id);
		}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->cart->select('*, detailpengiriman.id as dp_id')->join('distributor', 'distributor.id = distributor_id')
		->join('product_distributor', 'product_distributor.product_id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->where('cart_item.id', $id)->find();
		if($data[0]->dp_id != null){
			$pengiriman_id = $data[0]->pengiriman_id;
			$this->detailpengiriman->whereIn('pengiriman_id', [$pengiriman_id])->delete();
			$this->pengiriman->delete($pengiriman_id);
		}

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
