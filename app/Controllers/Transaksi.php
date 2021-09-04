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
		$this->pengirim = new PengirimanModel();
	}

	public function index()
	{
		$data['distributor'] = $this->distributor->findAll();
		
		$data['carts'] = $this->cart->select('cart_item.distributor_id as distributor_id, pengiriman.distributor_id as ped_id,  product_id, products.name,products.id as p_id, city.id_kota, address.id as a_id, cart_item.id as id, products.name, products.photos, products.sell_price,  address.kecamatan, address.kabupaten, address.provinsi, products.affiliate_commission, products.stockist_commission, product_id, products.photos, amount, total, pengiriman.ongkir, pengiriman.etd, pengiriman.kurir')
		->join('products', 'products.id = product_id', 'inner')
		->join('distributor', 'distributor.id = cart_item.distributor_id', 'inner')
		->join('address', 'address.user_id = distributor.user_id', 'inner')
		->join('city', 'city.kota = address.kabupaten', 'inner')
		->join('pengiriman', 'cart_item.distributor_id = pengiriman.distributor_id AND cart_item.user_id = pengiriman.user_id', 'left outer')
		->join('subdistrict', 'subdistrict.subsdistrict_name = address.kecamatan', 'inner')
		->where('address.type', 'distributor')
		->where('cart_item.user_id', user()->id)
		->find();

		$outer_array = array();
		$unique_array = array();

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



		    }else{		            
		            array_push($outer_array[$fid_value]['products'], $value);
		            $outer_array[$fid_value]['subtotal'][0] =  $outer_array[$fid_value]['subtotal'][0]  + $subtotal;

		    }
		}

		$data['carts'] = $outer_array;
		

		$data['category'] = $this->category->findAll();
		$data['address'] = $this->address->where('user_id', user()->id)->where('type', 'billing')->find();

		$data['billing'] = $this->address
		->where('user_id', user()->id)->where('address.type', 'billing')
		->join('city', 'city.kota = kabupaten', 'right')
		->join('subdistrict', 'subdistrict.subsdistrict_name = kecamatan', 'left')->first();


		
		$data['bills'] = $this->bill->limit(3)->find();

		return view('commerce/checkout', $data);
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
