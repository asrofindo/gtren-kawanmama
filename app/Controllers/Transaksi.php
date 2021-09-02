<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\CartItemModel;
use App\Models\AddressModel;
use App\Models\CategoryModel;
use App\Models\BillModel;
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
	public function __construct()
	{
		$this->model = new TransaksiModel();
		$this->cart = new CartItemModel();
		$this->category = new CategoryModel();
		$this->bill = new BillModel();
		$this->address = new AddressModel();
	}

	public function index()
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  	CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_ENCODING => "",
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 30,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_CUSTOMREQUEST => "POST",
		  	CURLOPT_POSTFIELDS => "origin=12&originType=city&destination=544&destinationType=subdistrict&weight=1700&courier=jne",
		  	CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: bfacde03a85f108ca1e684ec9c74c3a9"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl); 

		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		
		$data['ongkir'] = json_decode($response, true)['rajaongkir']['results'][0]['costs'];
		
		

		$data['carts'] = $this->cart->select('products.id as p_id, city.id_kota, address.id as a_id, users.id as u_id, cart_item.id as id, products.name, products.photos, products.sell_price, users.username, address.kecamatan, address.kabupaten, address.provinsi, products.affiliate_commission, products.stockist_commission, product_id, products.photos, amount, total, distributor_id')
		->join('products', 'products.id = product_id', 'left')
		->join('users', 'users.id = cart_item.user_id', 'left')
		->join('address', 'address.user_id = cart_item.user_id', 'left')
		->join('city', 'city.kota = address.kabupaten', 'right')
		->join('subdistrict', 'subdistrict.subsdistrict_name = address.kecamatan', 'left')
		->where('cart_item.user_id', user()->id)
		->where('address.type', 'distributor')
		->find();

		$sumTotal = 0;

		for($i = 0; count($data['carts']) > $i; $i++){
			$sumTotal += $data['carts'][$i]->total;
		}
		$data['total'] = $sumTotal;

		$data['category'] = $this->category->findAll();
		$data['address'] = $this->address->where('user_id', user()->id)->where('type', 'billing')->find();

		$data['billing'] = $this->address
		->where('user_id', user()->id)->where('address.type', 'billing')
		->join('city', 'city.kota = kabupaten', 'right')
		->join('subdistrict', 'subdistrict.subsdistrict_name = kecamatan', 'left')->find();


		
		$data['bills'] = $this->bill->limit(3)->find();

		return view('commerce/checkout', $data);
	}
	public function save()
	{


		dd($data);
	}
}
