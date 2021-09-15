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
use App\Models\DetailPengirimanModel;
use App\Models\DetailTransaksiModel;
use App\Models\PendapatanModel;
use App\Models\WDModel;
use App\Models\GenerateModel;
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
		$this->detail_pengirim = new DetailPengirimanModel();
		$this->detail_transaksi = new DetailTransaksiModel();
		$this->pendapatan = new PendapatanModel();
		$this->wd = new WDModel();
		$this->generate = new GenerateModel();
	}

	public function index()
	{
		$data['distributor'] = $this->distributor->findAll();
		

		$data['carts'] = $this->cart->select('*, distributor.id as distributor_id, detailtransaksi.id as d_id, cart_item.id as cart_id')
		->join('products', 'products.id = product_id', 'inner')
		->join('distributor', 'distributor.id = distributor_id')
		->join('address', 'address.user_id = distributor.user_id AND address.type = "distributor"')
		->join('city', 'city.kode_pos = address.kode_pos')
		->join('detailtransaksi', 'detailtransaksi.cart_id = cart_item.id', 'left')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('cart_item.user_id', user()->id)
		->where('cart_item.status', null)->findAll();

	 	$data_cart = [];
		foreach ($data['carts'] as $cart ) {
	     	if($cart->d_id == null){
     		 	
     		 	array_push($data_cart, $cart);
	     	} else {
	     		$data['carts'] = [];
	     	}
	    }

	    $data['carts'] = $data_cart;

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
		    $weight = $value->weight;
		    $amount = $value->amount;
		    $cart_id = $value->cart_id;

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
		            $outer_array[$fid_value]['weight'] = [$weight * $amount];
		            $outer_array[$fid_value]['ongkir'] = $ongkir;
		            $outer_array[$fid_value]['etd'] = $etd;
		            $outer_array[$fid_value]['kurir'] = $kurir;
		            $outer_array[$fid_value]['locate'] = $locate;

		            $outer_array[$fid_value]['cart_id'] = [$cart_id];

		    }else{		            
		            array_push($outer_array[$fid_value]['products'], $value);
		            $weightAfter = $weight * $amount;
		            $outer_array[$fid_value]['subtotal'][0] =  $outer_array[$fid_value]['subtotal'][0]  + $subtotal;		
		            $outer_array[$fid_value]['cart_id'][0] =  "{$outer_array[$fid_value]['cart_id'][0]},{$cart_id}";		
		            $outer_array[$fid_value]['weight'][0] =  "{$outer_array[$fid_value]['weight'][0]}, {$weightAfter}";		

		    }
		}
		$data['carts'] = $outer_array;

		foreach($data['carts'] as $cart){
			$total += $cart['subtotal'][0];
		}

		$data['generate'] = $this->generate->find();
		
		$data['total'] = $total + $data['generate'][0]['nomor'];
		$data['category'] = $this->category->findAll();
		$data['address'] = $this->address->where('user_id', user()->id)->where('type', 'billing')->find();

		$data['billing'] = $this->address
		->where('user_id', user()->id)->where('address.type', 'billing')
		->join('city', 'city.kota = kabupaten', 'right')
		->join('subdistrict', 'subdistrict.subsdistrict_name = kecamatan', 'left')->first();

		$data['bills'] = $this->bill->find();
		return view('commerce/checkout', $data);
	}

	public function save_transaction()
	{
		$total = $this->request->getPost('total');
		$bill = $this->request->getPost('bill');

		$kode_unik = $this->request->getPost('kode_unik');
		
		$data['carts'] = $this->cart->select('*, distributor.id as distributor_id, detailtransaksi.id as d_id, cart_item.id as cart_id, products.stockist_commission, products.affiliate_commission')
		->join('products', 'products.id = product_id')
		->join('distributor', 'distributor.id = distributor_id')
		->join('address', 'address.user_id = distributor.user_id AND address.type = "distributor"')
		->join('city', 'city.kode_pos = address.kode_pos')
		->join('detailtransaksi', 'detailtransaksi.cart_id = cart_item.id', 'left')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('cart_item.user_id', user()->id)
		->where('cart_item.status', null)
		->findAll();
		foreach ($data['carts'] as $c) {

			if($c->pengiriman_id == null && $bill == null){
				session()->setFlashdata('danger', 'Anda Harus Memilih Kurir Dan Metode Pembayaran');
				return redirect()->back();
			}
			if($c->pengiriman_id == null){
				session()->setFlashdata('danger', 'Anda Harus Memilih Kurir');
				return redirect()->back();
			}


		}

		if($bill == null){
			session()->setFlashdata('danger', 'Anda Harus Memilih Metode Pembayaran');
			return redirect()->back();
		}
		$data['alamat'] = $this->address->where('user_id', user()->id)->where('type', 'billing')->find()[0];
		$alamat = "{$data['alamat']->provinsi}, {$data['alamat']->kabupaten}, {$data['alamat']->kecamatan}, {$data['alamat']->kode_pos}, {$data['alamat']->detail_alamat}";
		
		$this->transaksi->insert([
			"user_id" => user()->id, 
			"kode_unik" => $kode_unik, 
			"bill_id" => $bill, 
			"status_pembayaran" => "pending", 
			"total" => $total, 
			"alamat" => $alamat]);
		
		foreach($data['carts'] as $cart){

			$data = [
				"id" => $cart->cart_id,
				"status" => "checkout"
			];

			$this->cart->save($data);

			$data = [
				"cart_id" => $cart->cart_id, 
				"affiliate_commission" => $cart->affiliate_link ? $cart->affiliate_commission : $cart->affiliate_link  , 
				"distributor_id" => $cart->distributor_id, 
				"stockist_commission" => $cart->stockist_commission +  $cart->fixed_price + $cart->ongkir_produk, 
				"admin_commission" => $cart->affiliate_link ?  $cart->sell_price - $cart->fixed_price - $cart->stockist_commission - $cart->affiliate_commission : $cart->sell_price - $cart->fixed_price - $cart->stockist_commission,
				"transaksi_id" => $this->transaksi->getInsertID(), 
			];

			$this->detail_transaksi->save($data);
		}

		$bill = $this->bill->where('id',$this->request->getPost('bill'))->first();
		$msg = base_url()." \n\n".user()->greeting." ".user()->fullname."\n"."Pesanan Anda *menunggu pembayaran* \nTagihan Total: ".$total."\nNomor Transaksi : ".$this->transaksi->getInsertID()."\nRekening ".$bill->bank_name."-".$bill->bank_number."-".$bill->owner."\nCek Pesanan Anda Di ".base_url('/orders');

		wawoo(user()->phone,$msg);

		$data['generate'] = $this->generate->find();
		$this->generate->save(["id" => 1, "nomor" => $data['generate'][0]['nomor'] + 1]);
		return redirect()->to('/orders');
		
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
    	
    	$destination = $r->getPost('origin'); 
    	$courier = $r->getPost('courier'); 
    	$origin = $r->getPost('destination'); 
    	$distributor_id = $r->getPost('distributor_id'); 
    	$weight = $r->getPost('weight');
    	$cart_id = $r->getPost('cart_id'); 

    	$cart_ids = explode(",",$cart_id);
    	$weights = explode(",",$weight);
    	$total_ongkir = 0;
    	$data_ongkir = [];  
    	$etd = '';
    	$address_user = $this->address->where('user_id', user()->id)->where('type', 'billing')->first();
    	$kode_pos = $address_user->kode_pos;
    	$kecamatan = $address_user->kecamatan;

    	$subdistrict_id = $this->address->
    	join('city', 'city.kode_pos = address.kode_pos', 'left')
    	->join('subdistrict', 'subdistrict.city_id = city.id_kota AND subdistrict.subsdistrict_name = address.kecamatan', 'left')
    	->where('address.type', 'billing')
    	->where('address.user_id', user()->id)
    	->first()->subsdistrict_id;

 		for($i = 0; $i < count($weights); $i++){
 			$curl = curl_init();
			curl_setopt_array($curl, array(
			  	CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
			  	CURLOPT_RETURNTRANSFER => true,
			  	CURLOPT_ENCODING => "",
			 	CURLOPT_MAXREDIRS => 10,
			  	CURLOPT_TIMEOUT => 100,
			  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  	CURLOPT_CUSTOMREQUEST => "POST",
			  	CURLOPT_POSTFIELDS => "origin={$origin}&originType=city&destination={$subdistrict_id}&destinationType=subdistrict&weight={$weights[$i]}&courier={$courier}",
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
			array_push($data_ongkir, $ongkir);
			$total_ongkir += $ongkir;
 		}

		$data['carts'] = $this->cart->select('*, distributor.id as distributor_id, cart_item.id as cart_id')
		->join('products', 'products.id = product_id', 'inner')
		->join('distributor', 'distributor.id = distributor_id')
		->join('address', 'address.user_id = distributor.user_id AND address.type = "distributor"')
		->join('city', 'city.kode_pos = address.kode_pos')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('cart_item.user_id', user()->id)
		->find();

		for ($i=0; $i < count($cart_ids); $i++) {
			if(count($this->detail_pengirim->where('cart_id', $cart_ids[$i])->find()) > 0){
				
				$id_detail_pengiriman = $this->detail_pengirim->where('cart_id', $cart_ids[$i])->find()[0]['id'];
				
				$data_ongkir_baru = 
				[
					"id" => $id_detail_pengiriman,
					"ongkir_produk" => $data_ongkir[$i],
				];
				
				$this->detail_pengirim->save($data_ongkir_baru);
				
				$pengirim_id= $this->detail_pengirim->where('cart_id', $cart_ids[$i])->findAll();
				
				foreach ($pengirim_id as $id) {

					$id_pengiriman = $this->pengirim->find($id['pengiriman_id']);
					
					$this->pengirim->save([
						"id" => $id_pengiriman['id'],
						"kurir" => $courier,
						"ongkir" => $total_ongkir,
						"etd" => $etd ? $etd : 'Tidak temukan' 
					]);
				
					return redirect()->back();
				}					
			}
    	}

		$this->pengirim->save([
			"user_id" => user()->id,
			"kurir" => $courier,
			"ongkir" => $total_ongkir,
			"etd" => $etd ? $etd : 'Tidak temukan' 
		]);

		for($i=0; $i < count($cart_ids); $i++){
			$this->detail_pengirim->save([
				"cart_id" => $cart_ids[$i], 
				"ongkir_produk" => $data_ongkir[$i], 
				"pengiriman_id" => $this->pengirim->getInsertID(), 
			]);
		}
		
		return redirect()->back();
	}

	public function hutang_stockist()
	{
		$data['pendapatans'] = $this->pendapatan->select('*, pendapatan.id as id')
		->join('distributor', 'distributor.user_id = pendapatan.user_id')
		->join('users', 'users.id = pendapatan.user_id')
		->where('pendapatan.status_dana', 'distributor')
		->find();
		$data['bills'] = $this->bill->findAll();
		$data['pager'] = $this->transaksi->paginate(5, 'pendapatan');
		$data['pager'] = $this->transaksi->pager;
		return view('db_admin/pendapatan/pendapatan_stockist', $data);
	}

	public function hutang_affiliate()
	{
		$data['pendapatans'] = $this->pendapatan
		->join('users', 'users.id = pendapatan.user_id')
		->where('pendapatan.status_dana', 'affiliate')
		->find();
	
		$data['bills'] = $this->bill->findAll();
		$data['pager'] = $this->transaksi->paginate(5, 'pendapatan');
		$data['pager'] = $this->transaksi->pager;
		return view('db_admin/pendapatan/pendapatan_affiliate', $data);
	}

	public function wd()
	{
		$id = $this->request->getPost('pendapatan_id');
		$wd = $this->request->getPost('wd');
		$bill_id = $this->request->getPost('bill');
		$status_dana = $this->request->getPost('status_dana');

		$data_pendapatan = $this->pendapatan->find($id);
		$data_bill = $this->bill->find($bill_id);


		$user_id = $this->pendapatan->first($id)->user_id;

		$id_wd = $this->wd->where('user_id', $user_id)->where('status_dana', $status_dana)->where('status', 'belum')->find()[0]['id'];

		if($data_bill->total == null){
			return redirect()->back();
		}

		if($data_pendapatan->total == 0){
			return redirect()->back();
		}


		$this->bill->save([
			"id" => $bill_id,
			"total" => $data_bill->total - $wd
		]);

		$data = [
			"id" => $id,
			"keluar" => $data_pendapatan->keluar + $wd,
			"total" => $data_pendapatan->total - $wd,
			"penarikan_dana" => $data_pendapatan->penarikan_dana - $wd
		];
		
		$this->pendapatan->save($data);

		$this->wd->save(["id" => $id_wd, "status" => "sudah", "bill_id" => $bill_id]);

		return redirect()->back();
	}

	public function tarik_dana()
	{
		$id = $this->request->getPost('pendapatan_id');
		$wd = $this->request->getPost('wd');
		$data_pendapatan = $this->pendapatan->find($id);

		$data = [
			"id" => $id,
			"penarikan_dana" => $wd
		];

		if($data_pendapatan->total == 0){
			return redirect()->back();
		}
		
		$this->pendapatan->save($data);

		return redirect()->back();
	}

	public function keuangan()
	{
		
		if(in_groups(3)){
			$data['pendapatan_seller'] = $this->pendapatan->where('user_id', user()->id)->where('status_dana', 'distributor')->find();
			$data['detailtransaksi'] = $this->detail_transaksi
			->join('distributor', 'distributor.id = detailtransaksi.distributor_id')
			->join('detailpengiriman', 'detailpengiriman.cart_id = detailtransaksi.cart_id')
			->join('cart_item', 'cart_item.id = detailtransaksi.cart_id')
			->where('distributor.user_id', user()->id)->where('status_barang', 'diterima')->findAll();
		}


		$data['pendapatan_affiliate'] = $this->pendapatan->where('user_id', user()->id)->where('status_dana', 'affiliate')->find();
		$data['detailtransaksi_affiliate'] = $this->detail_transaksi
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id')
		->join('users', 'users.affiliate_link = cart_item.affiliate_link')
		->where('users.id', user()->id)->where('status_barang', 'diterima_pembeli')->findAll();

		return view('db_stokis/keuangan', $data);
	}

	public function request_wd()
	{
		// data yang akan di wd
		$jumlah_wd = $this->request->getPost('jumlah_wd');
		$status_dana = $this->request->getPost('status_dana');

		// user id
		$id = user()->id;

		// 
		$penarikan = $this->pendapatan->where('user_id', user()->id)->where('status_dana', $status_dana)->first();

		// function untuk memperoleh wd sebelum nya
		$wd_belum = $this->wd->where('user_id', user()->id)->where('status', 'belum')->where('status_dana', $status_dana)->find();

		// function untuk memperoleh semua dana stockist atau affiliate dari table pendapatan 
		$data['pendapatan_affiliate'] = $this->pendapatan->select('total')->where('status_dana', 'affiliate')->where('user_id', user()->id)->findAll();
		$data['pendapatan_stockist'] = $this->pendapatan->select('sum(total) as total')->where('status_dana', 'distributor')->where('user_id', user()->id)->findAll();
		
		// jika ditemukan wd sebelumnya dan status nya adalah belum dikonfirmasi
		if(count($wd_belum) > 0){
			$data['wds'] = $this->wd->where('user_id', user()->id)->find();	
			$data['pendapatan'] = $this->pendapatan->select('sum(total) as total')->where('user_id', user()->id)->findAll();
			session()->setFlashdata('danger', 'Anda Harus Menunggu Pencairan Dana Sebelumnya');
			return view('db_stokis/wd', $data);
		}

		//jika jumlah wd nya tidak lebih besar dari 0 
		if(!$jumlah_wd > 0){

			$data['wds'] = $this->wd->where('user_id', user()->id)->find();
			$data['pendapatan'] = $this->pendapatan->select('sum(total) as total')->where('user_id', user()->id)->find();
			session()->setFlashdata('danger', 'Data Tidak Benar');
			return view('db_stokis/wd', $data);
		}


		if(count($this->pendapatan->where('user_id', user()->id)->find()) == 0 ){
			$data['wds'] = $this->wd->where('user_id', user()->id)->find();
			$data['pendapatan'] = $this->pendapatan->select('sum(total) as total')->where('user_id', user()->id)->find();

			return view('db_stokis/wd', $data);
		}

		if($this->pendapatan->where('user_id', user()->id)->where('status_dana', $status_dana)->find()[0]->total == 0){			
			$data['wds'] = $this->wd->where('user_id', user()->id)->find();
			$data['pendapatan'] = $this->pendapatan->select('sum(total) as total')->where('user_id', user()->id)->find();
			session()->setFlashdata('danger', 'Dana Tidak Cukup');
			return view('db_stokis/wd', $data);
		}

		if($this->pendapatan->where('user_id', user()->id)->where('status_dana', $status_dana)->find()[0]->total < $jumlah_wd){			
			$data['wds'] = $this->wd->where('user_id', user()->id)->find();
			$data['pendapatan'] = $this->pendapatan->select('sum(total) as total')->where('user_id', user()->id)->find();
			session()->setFlashdata('danger', 'Dana Tidak Cukup');
			return view('db_stokis/wd', $data);
		}

		$this->wd->save([
			"user_id" => $id,
			"jumlah_wd" => $jumlah_wd,
			"status" => "belum",
			"status_dana" => $status_dana
		]);

		$this->pendapatan->save([
			"id" => $penarikan->id,
			"penarikan_dana" => $jumlah_wd,
		]);		

		session()->setFlashdata('success', 'Sukses Meminta Pencairan Dana Mohon Ditunggu');
		return redirect()->back();
	}	

	public function riwayat_wd()
	{
		$data['wds'] = $this->wd->select('*, penarikan_dana.status as status_wd')
		->join('bills', 'bills.id = penarikan_dana.bill_id', 'inner')
		->join('users', 'users.id = penarikan_dana.user_id', 'inner')
		->where('penarikan_dana.status', 'sudah')
		->find();

		return view('db_admin/pendapatan/riwayat_wd', $data);
	}

}	
