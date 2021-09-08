<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\PengirimanModel;
use App\Models\DetailPengirimanModel;
use App\Controllers\BaseController;

class Order extends BaseController
{
	public function __construct()
	{
		$this->model = new TransaksiModel();
		$this->detailtransaksi = new DetailTransaksiModel();
		$this->pengiriman = new PengirimanModel();
		$this->detail_pengiriman = new DetailPengirimanModel();
	}
	public function update($id)
	{
		$status = $this->request->getPost("status");
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


		// variable untuk check raja ongkir
		$weight = $data['detailtransaksi']['weight'] * $data['detailtransaksi']['amount'];
		$destination = $data['detailtransaksi']['id_kota'];
		$courier = $data['detailtransaksi']['kurir'];
		$origin = $data['distributor'][0]['id_kota'];

		// check raja ongkir
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_ENCODING => "",
		 	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 100,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_CUSTOMREQUEST => "POST",
		  	CURLOPT_POSTFIELDS => "origin={$origin}&originType=city&destination={$destination}&destinationType=subdistrict&weight={$weight}&courier={$courier}",
		  	CURLOPT_HTTPHEADER => array(
		    	"content-type: application/x-www-form-urlencoded",
		    	"key: bfacde03a85f108ca1e684ec9c74c3a9"
		  	),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		// hasil data yang diperoleh dari raja ongkir
		$ongkir = json_decode($response)->rajaongkir->results[0]->costs[0]->cost[0]->value;
		$etd = json_decode($response)->rajaongkir->results[0]->costs[0]->cost[0]->etd;

		//  ubah ongkir
		$data['pengiriman'] = [
			"id" => $data['detailtransaksi']['p_id'],
			"ongkir" => $data['detailtransaksi']['ongkir'] - $ongkir
		];

		$this->pengiriman->save($data['pengiriman']);

		// ubah total transaksi 
		$total = $this->model->find($transaksi_id)->total;

		$data['transaksi'] = [
			"id" => $transaksi_id,
			"total" => $total - ($data['detailtransaksi']['total'] + $ongkir)
		];

		$this->model->save($data['transaksi']);

		// ubah status detail transaksi
		$data['detailtransaksi'] = [
			"id" => $id,
			"status_barang" => "refund"
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

		return redirect()->back();
	}

	public function order_verify($id)
	{
		$data = [
			"id" => $id,
			"status_barang" => "diterima",
		];

		$this->detailtransaksi->save($data);

		$transaksi_id = $this->detailtransaksi
		->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id')
		->where('detailtransaksi.transaksi_id', $id)->find();
		$data = [
			"id" => $transaksi_id,
			"status_pembayaran" => "dibayar"
		];
		
		$this->transaksi->save()
		return redirect()->back();
	}
}