<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\BillModel;
use App\Models\ProductDistributorModel;
use App\Models\DetailTransaksiModel;
use App\Models\PengirimanModel;
use App\Models\DetailPengirimanModel;
use App\Models\PendapatanModel;
use App\Models\DistributorModel;
use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;
use App\Models\NotifModel;
use App\Models\AddressModel;
use App\Models\CartItemModel;
use App\Models\SosialModel;
use App\Models\ProductModel;
use App\Controllers\PendaptanType;
use Dompdf\Dompdf;

class Order extends BaseController
{
	public function __construct()
	{
		$this->sosial = new SosialModel();
		$this->data['sosial']    = $this->sosial->findAll();
		$this->model = new TransaksiModel();
		$this->detailtransaksi = new DetailTransaksiModel();
		$this->pengiriman = new PengirimanModel();
		$this->detail_pengiriman = new DetailPengirimanModel();
		$this->productdistributor = new ProductDistributorModel();
		$this->pendapatan = new PendapatanModel();
		$this->distributor = new DistributorModel();
		$this->bills = new BillModel();
		$this->user = new UserModel();
		$this->cart = new CartItemModel();
		$this->product = new ProductModel();
		$this->notif = new NotifModel();
		$this->address = new AddressModel();


	}
	// admin konfirmasi sudah dibayar
	public function update($id)
	{
		// if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
		// 	session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
		// 	return redirect()->to('/distributor');
		// }
		// if (user()!=null && user()->phone == null) {
		// 	session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
		// 	return redirect()->to('/profile');
		// }
		$status = 'paid';
		if($this->request != null) {
			$status = $this->request->getPost("status");
		}


		$data['transaksi'] = $this->model->find($id);
		$data['bills'] = $this->bills->find($data['transaksi']->bill_id);
		if($status == 'paid'){
			$this->bills->save(["id" => $data['transaksi']->bill_id, "total" => $data['bills']->total + $data['transaksi']->total]);
			$pendapatanType = new PendapatanType();
			$initializePendapatan = $pendapatanType->initializePendapatan($data['transaksi'], 'user', '');
			$initializePendapatan->save();
		}

		$this->model->save(["id" => $id, "status_pembayaran" => $status, "batas_pesanan" => date( "Y-m-d H:i:s", strtotime( "+2 days" )),	
		]);

		$detail =$this->detailtransaksi->where('transaksi_id',$id)->groupBy('distributor_id')->get()->getResult();

		foreach ($detail as $key => $value) {
			$dostributor = $this->distributor->where('id',$value->distributor_id)->first();
			$user = $this->user->where('id',$dostributor['user_id'])->first();
			
			$msg=base_url()." \n\n".$user->greeting." ".$user->fullname."\n"."Selamat! Anda mendapat pesanan baru,\nNo Transaksi: ".$id."\nAnda harus *menerima* atau *menolak* pesanan ini di dasbor distributor. Batas waktu 2 hari.\nSilahkan Cek Transaksi di \n".base_url('/order/stockist');
			wawoo($user->phone,$msg);
		}
		
		$user = $this->user->where('id',$data['transaksi']->user_id)->first();
		$msg=base_url()." \n\n".$user->greeting." ".$user->fullname."\n"."Terimakasih, Pesanan Anda *sudah dibayar* \nNo Transaksi: ".$id."\nMohon ditunggu *konfirmasi dari distributor*. \n";
		wawoo($user->phone,$msg);

		$msg="Selamat!\n\nPesanan No.".$id." sudah dibayar.\n"."Cek di ".base_url('/order');
		$notif = $this->notif->findAll();
		foreach ($notif as $key => $value) {
			wawoo($value['phone'],$msg);
		}

		return redirect()->back();

	}

	public function order_acc($id)
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = [
			"id" => $id,
			"status_barang" => "diterima_seller"
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
			"id" => $product_transaksi[0]->pd_id,
			"jumlah" => $product_transaksi[0]->jumlah - $product_transaksi[0]->amount
		];

		$this->productdistributor->save($data);

		return redirect()->back();
	}

	public function order_ignore($id)
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = [
			"id" => $id,
			"status_barang" => "ditolak"
		];
		$detail=$this->detailtransaksi->where("id",$id)->first();
		$transaksi=$this->model->where("id",$detail->transaksi_id)->first();
		$user=$this->user->where('id',$transaksi->user_id)->first();

		$product= $this->detailtransaksi->select('products.name as product')
		->join('cart_item', 'cart_item.id = cart_id')
		->join('products', 'products.id = cart_item.product_id')
		->where('detailtransaksi.id',$id)
		->first();

		$msg=base_url()." \n\n"
		.$user->greeting." ".$user->fullname."\n"."Kami informasikan, Pesanan Anda *ditolak oleh distributor* \nNo Transaksi: ".$transaksi->id."\n".'Dengan detail product '.$product->product.'\n*Dana Anda Akan Segera Dikembalikan* oleh Admin.\nSetelah itu Anda dapat memesan kembali ke distributor yang berbeda.';
		wawoo($user->phone,$msg);

		$msg=base_url()." \n\n"."Pesanan ini *DITOLAK OLEH SELLER*\nSegera lakukan *REFUND* kepada pembeli.\nNo Transaksi: ".$transaksi->id."\nNama pembeli: ".$user->fullname."\nKunjungi: ".base_url('/order');

		$notif = $this->notif->findAll();
		foreach ($notif as $key => $value) {
			wawoo($value['phone'],$msg);
		}

		$this->detailtransaksi->save($data);
		return redirect()->back();

	}

	public function order_refund($transaksi_id, $id)
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}

		// data produk dan ongkir yang akan di refund
		$data['detailtransaksi'] = $this->detailtransaksi->select('*, pengiriman.id as p_id, detailtransaksi.admin_commission, detailtransaksi.affiliate_commission, detailtransaksi.stockist_commission, detailpengiriman.ongkir_produk, detailpengiriman.id as dp_id')
		->join('cart_item', 'cart_item.id = cart_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id')
		->join('products', 'products.id = cart_item.product_id')
		->join('users', 'users.id = cart_item.user_id')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id')
		->join('address', 'address.user_id = users.id')
		->join('city', 'city.kode_pos = address.kode_pos')
		->find($id);

		// jika barang sudah direfund atau barang tidak ditolak oleh stockist maka tidak di perbolehkan 
		if($data['detailtransaksi']->status_barang == 'refund'){
			return redirect()->back();
		}

		if($data['detailtransaksi']->status_barang != 'ditolak'){
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
		if($data['detailtransaksi']->amount >= 1 && $data['detailtransaksi']->ongkir == $data['detailtransaksi']->ongkir_produk){

			$data['pengiriman'] = [
				"id" => $data['detailtransaksi']->p_id,
				"ongkir" => $data['detailtransaksi']->ongkir
			];
		} else {
			$data['pengiriman'] = [
				"id" => $data['detailtransaksi']->p_id,
				"ongkir" => $data['detailtransaksi']->ongkir -  $data['detailtransaksi']->ongkir_produk
			];
		}
	
		$this->pengiriman->save($data['pengiriman']);

		$data['detailpengiriman'] = [
			"id" => $data['detailtransaksi']->dp_id,
			"ongkir_produk" => '0'
		];

		$total = $this->detail_pengiriman->save($data['detailpengiriman']);
		// ubah total transaksi 
		$total = $this->model->find($transaksi_id)->total;

		$data['transaksi'] = [
			"id" => $transaksi_id,
			"total" => $total - ($data['detailtransaksi']->total + $data['detailtransaksi']->ongkir_produk)
		];

		$this->model->save($data['transaksi']);

		// Ubah total bank
		$bill_id = $this->model->find($transaksi_id)->bill_id;
		$total = $this->bills->find($bill_id)->total;

		// $data['bills'] = [
		// 	"id" => $bill_id,
		// 	"total" => $total - ($data['detailtransaksi']->total + $data['detailtransaksi']->ongkir_produk)
		// ];

		// $this->bills->save($data['bills']);
		$data['transaksi'] = $this->model->where('id', $transaksi_id)->first();
		$pendapatan = new PendapatanType();
		$initializePendapatan = $pendapatan->initializePendapatan($data['detailtransaksi'], 'user', 2);
		$initializePendapatan->save();
		
		// ubah status detail transaksi
		$data['detailtransaksi'] = [
			"id" => $id,
			"status_barang" => "refund",
			"stockist_commission" => '0',
			"affiliate_commission" => '0',
			"admin_commission" => '0',
			"stockist_commission" => '0',
		];

		$transaksi = $this->model->where('id',$transaksi_id)->first();
		$user = $this->user->where('id',$transaksi->user_id)->first();

		$product= $this->detailtransaksi->select('products.name as product')
		->join('cart_item', 'cart_item.id = cart_id')
		->join('products', 'products.id = cart_item.product_id')
		->where('detailtransaksi.id',$id)
		->first();

		
		$this->detailtransaksi->save($data['detailtransaksi']);
		
		$msg=base_url()." \n\n".$user->greeting." ".$user->fullname."\n"."Pesanan Anda No Transaksi : ".$transaksi_id."\ndetail product : ".$product->product."\nsudah dilakukan *PENGEMBALIAN DANA*\nSilakan cek halaman keuangan anda di : ".base_url("/rekening").".\nAnda dapat melakukan pesan ulang ke distributor lain.";

		wawoo($user->phone,$msg);

		return redirect()->back();

	}

	public function save_resi()
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		// data yang akan di input kan ke database
		$resi = $this->request->getPost('resi');
		$order_id = $this->request->getPost('order_id');

		// data dari transaksi dan detail transaksi
		$id_transaksi = $this->model->find($order_id)->id;
 
		$data_transaksis = $this->detailtransaksi->select('detailtransaksi.id as id, cart_item.amount, detailtransaksi.status_barang  as status_barang')
		->join('distributor', 'distributor.id = detailtransaksi.distributor_id', 'left')
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id')
		->where('transaksi_id', $id_transaksi)
		->where('distributor.user_id', user()->id)
		->findAll();
		
		// total barang yang di beli oleh user
		$amount = [];
		$data_null = [];

		foreach ($data_transaksis as $t) {
			if($t->status_barang == null){
				array_push($data_null, $t);
			}
		}

		if(count($data_null) == 0){
			
			// looping dan mengubah data resi dan status barang di dalam table detail transaksi 
			$distributors = $this->detailtransaksi
			->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id')
			->join('cart_item', 'cart_item.id = detailtransaksi.cart_id')->where('detailtransaksi.status_barang', 'diterima_seller')
			->where('transaksi.id', $id_transaksi)
			->find();

			foreach ($data_transaksis as $data_transaksi) {
	          	
				$id = $data_transaksi->id;

		        array_push($amount,  $data_transaksi->amount);
	          	if($data_transaksi->status_barang == 'diterima_seller'){ 		
		          	$data = [
						"id" => $data_transaksi->id,
						"resi" => $resi,
						"tanggal_resi" =>  date( "Y-m-d H:i:s", strtotime( "+10 days")),
						"status_barang" => "dikirim"
					];
		          
		 
					$this->detailtransaksi->save($data);
                  
                  		// mengurangi jumlah barang dari distributor dan data distributor
			
			$dis = '';
			for($i = 0; $i < count($distributors); $i++){

				
				
				$productdistributor_id = $this->productdistributor->where('distributor_id', $distributors[$i]->distributor_id)->where('product_id', $distributors[$i]->product_id)->find();
				
				$this->productdistributor->save([
					"id" => $productdistributor_id[0]->id,
					"jumlah" => $productdistributor_id[0]->jumlah - $distributors[$i]->amount
				]);
				$dis = $distributors[$i]->user_id;
			}
			
	
			$user=$this->user->where('id',$dis)->first();

			$msg=base_url()." \n\n".$user->greeting." ".$user->fullname."\n"."Selamat! Pesanan Anda *sudah dikirim*\nNo Transaksi: ".$id."\nNomor Resi: ".$resi."\nSilahkan Cek Transaksi di \n".base_url('/tracking');
			
			wawoo($user->phone,$msg);

			// dan yang terakhir adalah redirect back
			session()->setFlashdata('success', 'Sukses Menginput Resi');
	          	} 

			} 
			

			return redirect()->back();

		} else {
			session()->setFlashdata('danger', 'Gagal, Input Resi! Semua Barang Harus Ditolak Atau Diterima Terlebih Dahulu');
			return redirect()->back();
		}
	}

	public function order_verify($id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		// ubah status detail transaksi 
		$data = [
			"id" => $id,
			"status_barang" => "diterima_pembeli", 
		];


		$this->detailtransaksi->save($data);


		// $this->model->save($data);

		
		$transaksis = $this->detailtransaksi
		->select('*, distributor.user_id as penjual_id, cart_item.user_id as pembeli_id')
		->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id')
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id' )
		->join('distributor', 'distributor.id = cart_item.distributor_id')
		->where('detailtransaksi.id', $id)->find();

		$id_affiliate = explode("/", $transaksis[0]->affiliate_link); 
		// apakah di dalam table pendapatan terdapat seller yang sama
		if(count($this->pendapatan->where('user_id', $transaksis[0]->penjual_id)->find()) > 0){

			$detail_transaksi = $this->pendapatan->where('user_id', $transaksis[0]->penjual_id)->where('status_dana', 'distributor')->find();

			$data['pendapatan'] = [
				"id" => $detail_transaksi[0]->id,
				"masuk" => $detail_transaksi[0]->masuk + $transaksis[0]->stockist_commission,
				"total" => $detail_transaksi[0]->total + $transaksis[0]->stockist_commission,
			];

			$this->pendapatan->save($data['pendapatan']);
			

		}  
		

		else {
			
			$data['pendapatan'] = [
				"user_id" => $transaksis[0]->penjual_id,
				"masuk" => $transaksis[0]->stockist_commission,
				"keluar" => null,
				"status_dana" => "distributor",
				"total" => $transaksis[0]->stockist_commission,
			];
			$this->pendapatan->save($data['pendapatan']);
			
		}
		
		if($transaksis[0]->affiliate_link != null){

			$id_affiliate = explode("/", $transaksis[0]->affiliate_link); 

			if(count($this->pendapatan->where('user_id', $id_affiliate[2])->where('status_dana', 'affiliate')->find()) > 0)
				{
					$detail_transaksi = $this->pendapatan->where('user_id', $id_affiliate[2])->where('status_dana', 'affiliate')->find();
					
					$data['pendapatan'] = [
						"id" => $detail_transaksi[0]->id,
						"masuk" => $detail_transaksi[0]->masuk + $transaksis[0]->affiliate_commission,
						"total" => $detail_transaksi[0]->total + $transaksis[0]->affiliate_commission,
					];

					$this->pendapatan->save($data['pendapatan']);
				}

			else {
				$data['pendapatan'] = [
					"user_id" => $id_affiliate[2],
					"masuk" => $transaksis[0]->affiliate_commission,
					"status_dana" => "affiliate",
					"total" => $transaksis[0]->affiliate_commission,
				];
				
				$this->pendapatan->save($data['pendapatan']);
			}

		}

		$user = $this->user->where('id',$transaksis[0]->penjual_id)->first();
		$msg=base_url()." \n\n".$user->greeting." ".$user->fullname."\n"."Selamat!\nTransaksi No : ".$id." *sudah selesai*.\nSilahkan Cek Tabungan Anda di sini: \n".base_url('/request/wd');
		wawoo($user->phone,$msg);

		// uang masuk ke dompet stockis / affiliate / admin
		return redirect()->back();
	}

	public function pdf($value='')
	{

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml(view('db_stokis/detail_order'));

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
	}

}