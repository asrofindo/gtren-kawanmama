<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\CartItemModel;
use App\Models\AddressModel;
use App\Models\CategoryModel;
use App\Models\BillModel;
use App\Models\ProductModel;
use App\Models\DistributorModel;
use App\Models\PengirimanModel;
use App\Models\DetailTransaksiModel;
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
	public function __construct()
	{
		$this->model = new TransaksiModel();
		$this->cart = new CartItemModel();
		$this->category = new CategoryModel();
		$this->bill = new BillModel();
		$this->product = new ProductModel();
		$this->address = new AddressModel();
		$this->distributor = new AddressModel();
		$this->transaksi = new TransaksiModel();
		$this->pengirim = new PengirimanModel();
		$this->detail_transaksi = new DetailTransaksiModel();
	}

	public function index()
	{
		$data['distributor'] = $this->distributor->findAll();
		

		$data['carts'] = $this->cart->select('*, distributor.id as distributor_id, detailtransaksi.id as d_id')
		->join('products', 'products.id = product_id', 'inner')
		->join('distributor', 'distributor.id = distributor_id')
		->join('address', 'address.user_id = distributor.user_id AND address.type = "distributor"')
		->join('city', 'city.kode_pos = address.kode_pos')
		->join('detailtransaksi', 'detailtransaksi.cart_id = cart_item.id', 'left')
		->join('pengiriman', 'pengiriman.user_id = cart_item.user_id AND pengiriman.distributor_id = cart_item.distributor_id', 'left outer')
		->where('cart_item.user_id', user()->id)
		->findAll();
		foreach ($data['carts'] as $cart ) {
	     	if($cart->d_id == null){
     		 	
     		 	$data['carts'] = [];
     		 	array_push($data['carts'], $cart);
	     	} else {
	     		$data['carts'] = [];
	     	}
	    }

		$outer_array = array();
		$unique_array = array();
		$total = 0;

		foreach($data['carts'] as $key => $value)
		{

		    $inner_array = array();

		    $fid_value = $value->distributor_id;
		    $id_kota = $value->id_kota;
		    $subtotal = $value->total;
		    $kecamatan = $value->kecamatan;
		    $kabupaten = $value->kabupaten;
		    $ongkir = $value->ongkir;
		    $etd = $value->etd;
		    $kurir = $value->kurir;
		    $locate = $value->locate;
		    if(!in_array($value->distributor_id, $unique_array))
		    {
		            array_push($unique_array, $fid_value);
		            array_push($inner_array, $value);
		           
		            $outer_array[$fid_value]['distributor_id'] = $fid_value;
		            $outer_array[$fid_value]['kecamatan'] = $kecamatan;
		            $outer_array[$fid_value]['kabupaten'] = $kabupaten;

		            $outer_array[$fid_value]['products'] = $inner_array;
		            $outer_array[$fid_value]['id_kota'] = $id_kota;
		            $outer_array[$fid_value]['subtotal'] = [$subtotal + $ongkir];
		            $outer_array[$fid_value]['ongkir'] = $ongkir;
		            $outer_array[$fid_value]['etd'] = $etd;
		            $outer_array[$fid_value]['kurir'] = $kurir;
		            $outer_array[$fid_value]['locate'] = $locate;

		    }else{		            
		            array_push($outer_array[$fid_value]['products'], $value);
		            $outer_array[$fid_value]['subtotal'][0] =  $outer_array[$fid_value]['subtotal'][0]  + $subtotal;		

		    }
		}


		$data['carts'] = $outer_array;

		foreach($data['carts'] as $cart){
			$total += $cart['subtotal'][0];
		}

		$data['total'] = $total;
		$data['category'] = $this->category->findAll();
		$data['address'] = $this->address->where('user_id', user()->id)->where('type', 'billing')->find();

		$data['billing'] = $this->address
		->where('user_id', user()->id)->where('address.type', 'billing')
		->join('city', 'city.kota = kabupaten', 'right')
		->join('subdistrict', 'subdistrict.subsdistrict_name = kecamatan', 'left')->first();


		
		$data['bills'] = $this->bill->limit(3)->find();

		return view('commerce/checkout', $data);
	}

	public function save_transaction()
	{
		$total = $this->request->getPost('total');
		
		$data['carts'] = $this->cart->select('*, distributor.id as distributor_id, cart_item.id as cart_id')
		->join('products', 'products.id = product_id', 'inner')
		->join('distributor', 'distributor.id = distributor_id')
		->join('address', 'address.user_id = distributor.user_id AND address.type = "distributor"')
		->join('city', 'city.kode_pos = address.kode_pos')
		->join('pengiriman', 'pengiriman.user_id = cart_item.user_id AND pengiriman.distributor_id = cart_item.distributor_id', 'left outer')
		->where('cart_item.user_id', user()->id)
		->find();
		$this->transaksi->insert(["user_id" => user()->id, "status_pembayaran" => "proses", "total" => $total]);
		
		foreach($data['carts'] as $cart){
			$this->detail_transaksi->save([
				"cart_id" => $cart->cart_id, 
				"affiliate_commission" => $cart->affiliate_commission, 
				"stockist_commission" => $cart->stockist_commission, 
				"transaksi_id" => $this->transaksi->getInsertID(), 
			]);
		}
	}

	public function save_kurir()
	{
		$city_distributor_id = $this->request->getPost('city_id');

		$city_user_id = $this->address->where('user_id', user()->id)->where('address.type', 'billing')
		->join('city', 'city.kota = kabupaten', 'right')
		->join('subdistrict', 'subdistrict.subsdistrict_name = kecamatan', 'left')->find();


	}

	public function check()
	{
		$r = $this->request;
    	
    	$origin = $r->getPost('origin'); 
    	$courier = $r->getPost('courier'); 
    	$destination = $r->getPost('destination'); 
    	$distributor_id = $r->getPost('distributor_id'); 

   			$curl = curl_init();
			curl_setopt_array($curl, array(
			  	CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
			  	CURLOPT_RETURNTRANSFER => true,
			  	CURLOPT_ENCODING => "",
			 	CURLOPT_MAXREDIRS => 10,
			  	CURLOPT_TIMEOUT => 100,
			  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  	CURLOPT_CUSTOMREQUEST => "POST",
			  	CURLOPT_POSTFIELDS => "origin={$origin}&originType=city&destination={$destination}&destinationType=subdistrict&weight=1700&courier={$courier}",
			  	CURLOPT_HTTPHEADER => array(
			    	"content-type: application/x-www-form-urlencoded",
			    	"key: bfacde03a85f108ca1e684ec9c74c3a9"
			  	),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			$ongkir = json_decode($response)->rajaongkir->results[0]->costs[0]->cost[0]->value;
			$etd = json_decode($response)->rajaongkir->results[0]->costs[0]->cost[0]->etd;

		$data = [
			"distributor_id" => $distributor_id,
			"user_id" => user()->id,
			"kurir" => $courier,
			"ongkir" => $ongkir,
			"etd" => $etd ? $etd : 'Tidak temukan' 
		];

    	$check_data = $this->pengirim->where('user_id', user()->id)->where('distributor_id', $distributor_id)->first();
    	if($check_data){
    		$data = [
	    		"id" => $check_data['id'],
				"kurir" => $courier,
				"ongkir" => $ongkir,
				"etd" => $etd ? $etd : 'Tidak temukan' 
			];
    		$this->pengirim->save($data);
    		return redirect()->back();

    	}

		if($this->pengirim->save($data)){
			return redirect()->back();
		}

	}
}
