<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\BillModel;
use App\Models\ProductDistributorModel;
use App\Models\DetailTransaksiModel;
use App\Models\PengirimanModel;
use App\Models\DetailPengirimanModel;
use App\Models\PendapatanModel;
use App\Controllers\BaseController;

class Order extends BaseController
{
	public function __construct()
	{
		$this->model = new TransaksiModel();
		$this->detailtransaksi = new DetailTransaksiModel();
		$this->pengiriman = new PengirimanModel();
		$this->detail_pengiriman = new DetailPengirimanModel();
		$this->productdistributor = new ProductDistributorModel();
		$this->pendapatan = new PendapatanModel();
		$this->bills = new BillModel();
	}
	public function update($id)
	{
		$status = $this->request->getPost("status");
		if($status == 'paid'){
			$data['transaksi'] = $this->model->find($id);
			$data['bills'] = $this->bills->find($data['transaksi']->bill_id);
			
			$this->bills->save(["id" => $data['transaksi']->bill_id, "total" => $data['bills']->total + $data['transaksi']->total]);
		}
		$this->model->save(["id" => $id, "status_pembayaran" => $status]);
		return redirect()->back();

	}

	public function order_acc($id)
	{
		$data = [
			"id" => $id,
			"status_barang" => "diterima"
		];

		$this->detailtransaksi->save($data);


		// ubah stok product distributor
		$product_transaksi = $this->detailtransaksi->select('*, product_distributor.id as pd_id')
		->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id')
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id')
		->join('distributor', 'distributor.id = cart_item.distributor_id')
		->join('product_distributor', 'product_distributor.distributor_id = cart_item.distributor_id AND product_distributor.product_id = cart_item.product_id')
		->where('detailtransaksi.id', $id)->find();


		$data = [
			"id" => $product_transaksi[0]['pd_id'],
			"jumlah" => $product_transaksi[0]['jumlah'] - $product_transaksi[0]['amount']
		];

		$this->productdistributor->save($data);

		return redirect()->back();
	}

	public function order_ignore($id)
	{
		$data = [
			"id" => $id,
			"status_barang" => "ditolak"
		];

		$this->detailtransaksi->save($data);
		return redirect()->back();

	}

	public function order_refund($transaksi_id, $id)
	{
		
		// data produk dan ongkir yang akan di refund
		$data['detailtransaksi'] = $this->detailtransaksi->select('*, pengiriman.id as p_id')
		->join('cart_item', 'cart_item.id = cart_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id')
		->join('products', 'products.id = cart_item.product_id')
		->join('users', 'users.id = cart_item.user_id')
		->join('pengiriman', 'pengiriman.user_id = cart_item.user_id')
		->join('address', 'address.user_id = users.id')
		->join('city', 'city.kode_pos = address.kode_pos')
		->find($id);

		// jika barang sudah direfund atau barang tidak ditolak oleh stockist maka tidak di perbolehkan 
		if($data['detailtransaksi']['status_barang'] == 'refund'){
			return redirect()->back();
		}

		if($data['detailtransaksi']['status_barang'] != 'ditolak'){
			return redirect()->back();
		}
		// data distributor 
		$data['distributor'] = $this->detailtransaksi
		->join('cart_item', 'cart_item.id = cart_id')
		->join('products', 'products.id = cart_item.product_id')
		->join('distributor', 'distributor.id = cart_item.distributor_id')
		->join('address', 'address.user_id = distributor.user_id AND address.type = "distributor"')
		->join('city', 'city.kode_pos = address.kode_pos')
		->where('detailtransaksi.id', $id)
		->find();
		
		//  ubah ongkir
		$data['pengiriman'] = [
			"id" => $data['detailtransaksi']['p_id'],
			"ongkir" => $data['detailtransaksi']['ongkir'] -  $data['detailtransaksi']['ongkir_produk']
		];

		$this->pengiriman->save($data['pengiriman']);

		// ubah total transaksi 
		$total = $this->model->find($transaksi_id)->total;

		$data['transaksi'] = [
			"id" => $transaksi_id,
			"total" => $total - ($data['detailtransaksi']['total'] + $data['detailtransaksi']['ongkir_produk'])
		];

		$this->model->save($data['transaksi']);

		// Ubah total bank
		$bill_id = $this->model->find($transaksi_id)->bill_id;
		$total = $this->bills->find($bill_id)->total;

		$data['bills'] = [
			"id" => $bill_id,
			"total" => $total - ($data['detailtransaksi']['total'] + $data['detailtransaksi']['ongkir_produk'])
		];

		$this->bills->save($data['bills']);

		// ubah status detail transaksi
		$data['detailtransaksi'] = [
			"id" => $id,
			"status_barang" => "refund",
		];

		$this->detailtransaksi->save($data['detailtransaksi']);

		return redirect()->back();

	}

	public function save_resi()
	{
		$resi = $this->request->getPost('resi');
		$order_id = $this->request->getPost('order_id');

		$data = [
			"id" => $order_id,
			"status_barang" => "Dikirim",
			"resi" => $resi
		];

		$this->detailtransaksi->save($data);
		
		$detail = $this->detailtransaksi
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id')
		->find($order_id);

		$distributor = $this->productdistributor
		->where('distributor_id', $detail['distributor_id'])
		->where('product_id', $detail['product_id'])->find();
		$this->productdistributor->save([
			"id" => $distributor[0]->id,
			"jumlah" => $distributor[0]->jumlah - $detail['amount']
		]);



		return redirect()->back();
	}

	public function order_verify($id)
	{

		// ubah status detail transaksi 
		$data = [
			"id" => $id,
			"status_barang" => "diterima",
		];

		$this->detailtransaksi->save($data);


		// $this->model->save($data);

		$transaksis = $this->detailtransaksi
		->select('*, distributor.user_id as penjual_id, cart_item.user_id as pembeli_id')
		->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id')
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id' )
		->join('distributor', 'distributor.id = cart_item.distributor_id')
		->where('detailtransaksi.id', $id)->find();

		$id_affiliate = explode("/", $transaksis[0]['affiliate_link']); 
		// apakah di dalam table pendapatan terdapat seller yang sama
		if(count($this->pendapatan->where('user_id', $transaksis[0]['penjual_id'])->find()) > 0){

			$detail_transaksi = $this->pendapatan->where('user_id', $transaksis[0]['penjual_id'])->where('status_dana', 'distributor')->find();

			$data['pendapatan'] = [
				"id" => $detail_transaksi[0]->id,
				"masuk" => $detail_transaksi[0]->masuk + $transaksis[0]['stockist_commission'],
				"total" => $detail_transaksi[0]->total + $transaksis[0]['stockist_commission'],
			];

			$this->pendapatan->save($data['pendapatan']);
			

		}  
		

		else {
			
			$data['pendapatan'] = [
				"user_id" => $transaksis[0]['penjual_id'],
				"masuk" => $transaksis[0]['stockist_commission'],
				"keluar" => null,
				"status_dana" => "distributor",
				"total" => $transaksis[0]['stockist_commission'],
			];
			$this->pendapatan->save($data['pendapatan']);
			
		}
		
		if($transaksis[0]['affiliate_link'] != null){

			$id_affiliate = explode("/", $transaksis[0]['affiliate_link']); 

			if(count($this->pendapatan->where('user_id', $id_affiliate[2])->where('status_dana', 'affiliate')->find()) > 0)
				{
					$detail_transaksi = $this->pendapatan->where('user_id', $id_affiliate[2])->where('status_dana', 'affiliate')->find();
					
					$data['pendapatan'] = [
						"id" => $detail_transaksi[0]->id,
						"masuk" => $detail_transaksi[0]->masuk + $transaksis[0]['affiliate_commission'],
						"total" => $detail_transaksi[0]->total + $transaksis[0]['affiliate_commission'],
					];

					$this->pendapatan->save($data['pendapatan']);
				}

			else {
				$data['pendapatan'] = [
					"user_id" => $id_affiliate[2],
					"masuk" => $transaksis[0]['affiliate_commission'],
					"status_dana" => "affiliate",
					"total" => $transaksis[0]['affiliate_commission'],
				];
				
				$this->pendapatan->save($data['pendapatan']);
			}

		}

		// uang masuk ke dompet stockis / affiliate / admin
		return redirect()->back();
	}



}