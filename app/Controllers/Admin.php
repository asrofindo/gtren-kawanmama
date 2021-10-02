<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use Myth\Auth\Models\UserModel;
use App\Models\TransaksiModel;
use App\Models\DistributorModel;
use App\Models\NotifModel;
use App\Models\SosialModel;
use App\Models\KonfirmasiModel;
use App\Models\AddressModel;
use Myth\Auth\Authorization\GroupModel;
use Dompdf\Dompdf;

class Admin extends BaseController
{
	public $model;
	public $transaksi;
	public $konfirmasi;
	public $distributor;
	public $notif;


	public function __construct()

	{
		$this->user = new UserModel();
		$this->transaksi = new TransaksiModel();
		$this->konfirmasi = new KonfirmasiModel();
		$this->address = new AddressModel();

		$this->distributor = new DistributorModel();
		$this->notif = new NotifModel();
		$this->sosial = new SosialModel();
		$this->data['sosial']    = $this->sosial->findAll();

	}
	public function index()
	{
		return view('db_admin/produk/tambah_produk');
	}

	public function notifikasi()
	{
		if ($this->request->getPost('name')!=null) {
			$set=[
				'name'=>$this->request->getPost('name'),
				'phone'=>hp($this->request->getPost('phone')),
			];
			$this->notif->save($set);
		}
		$data['contacts']=$this->notif->find();
		return view('db_admin/contact/notif',$data);
	}
	public function notifikasi_delete($id)
	{

		$data['contacts']=$this->notif->delete($id);
		return redirect()->back();
	}
	public function produk_list()
	{
		
		return view('db_admin/produk/produk_list');
	}
	
	public function order()
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}

		$data['orders'] = $this->transaksi->select('*, group_concat(detailtransaksi.status_barang) as status_barang,transaksi.id as id,transaksi.created_at')
		->join('users', 'users.id = transaksi.user_id', 'left')
		->join('detailtransaksi', 'detailtransaksi.transaksi_id = transaksi.id', 'left')
         ->groupBy('detailtransaksi.transaksi_id')
		->orderBy('transaksi.id', 'DESC')
		->find(); 


		$data['pager'] = $this->transaksi->paginate(5, 'orders');
		$data['pager'] = $this->transaksi->pager;

		return view('db_admin/order/order', $data);

	}

	public function order_stockist()
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		$id = user()->id;

		if ($this->request->getPost('id')!=null) {
			$data['orders'] = $this->transaksi
			->select('*, group_concat(detailtransaksi.status_barang) as status_barangs, transaksi.total as total_transaksi, transaksi.id as id, detailtransaksi.id as detail_id, transaksi.created_at as created_at, sum(detailtransaksi.stockist_commission) as stockist_commission')
			->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
			->join("cart_item", 'cart_item.id = cart_id')
			->join("products", 'products.id = cart_item.product_id')
			->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
			->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
			->join('distributor', 'distributor.id = cart_item.distributor_id')
			->join('users', 'users.id = transaksi.user_id')
			->where('distributor.user_id', user()->id)
			->where('transaksi.id', $this->request->getPost('id'))
			->where('transaksi.batas_pesanan >', date( "Y-m-d H:i:s"))
			->where('transaksi.status_pembayaran', 'paid')->groupBy('transaksi.id')->orderBy('transaksi.id', 'DESC')
			->findAll();
		}else{
			$data['orders'] = $this->transaksi
			->select('*, group_concat(detailtransaksi.status_barang) as status_barangs, transaksi.total as total_transaksi, transaksi.id as id, detailtransaksi.id as detail_id, transaksi.created_at as created_at, sum(detailtransaksi.stockist_commission) as stockist_commission')
			->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
			->join("cart_item", 'cart_item.id = cart_id')
			->join("products", 'products.id = cart_item.product_id')
			->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
			->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
			->join('distributor', 'distributor.id = cart_item.distributor_id')
			->join('users', 'users.id = transaksi.user_id')
			->where('distributor.user_id', user()->id)
			->where('transaksi.batas_pesanan >', date( "Y-m-d H:i:s"))
			->where('transaksi.status_pembayaran', 'paid')->groupBy('transaksi.id')->orderBy('transaksi.id', 'DESC')
			->findAll();
		}
		
		$data['pager'] = $this->transaksi->paginate(10, 'orders');
		$data['pager'] = $this->transaksi->pager;

		return view('db_stokis/order', $data);

	}

	// order detaiil stockist
	public function order_detail_stockist($id)
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}

		$data['detail_orders'] = $this->transaksi
		->select('*, transaksi.total as total_transaksi, detailtransaksi.id as id, detailtransaksi.stockist_commission')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("bills", 'bills.id = bill_id')
		->join("users", 'users.id = transaksi.user_id')
		->join("cart_item", 'cart_item.id = cart_id')
		->join('distributor', 'distributor.id = cart_item.distributor_id', 'left')
		->join("products", 'products.id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('detailtransaksi.transaksi_id', $id)->where('distributor.user_id', user()->id)->findAll();
		
      
      $data['total_transaksi'] = $this->transaksi
		->select('*, sum(COALESCE(detailtransaksi.stockist_commission, 0) + COALESCE(detailtransaksi.admin_commission, 0) + COALESCE(detailtransaksi.affiliate_commission, 0)) as total_transaksi, distributor.id as id')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("bills", 'bills.id = bill_id')
		->join("users", 'users.id = transaksi.user_id')
		->join("cart_item", 'cart_item.id = cart_id')
		->join('distributor', 'distributor.id = detailtransaksi.distributor_id', 'left')
		->join("products", 'products.id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('detailtransaksi.transaksi_id', $id)->where('distributor.user_id', user()->id)->findAll();
		      
		$outer_array = array();
		$unique_array = array();
		$data['id'] = $data['total_transaksi'][0]->transaksi_id;
		foreach($data['detail_orders'] as $key => $value)
		{

		    $inner_array = array();

		    $fid_value = $value->user_id;
		  
		    $username = $value->username;
		    $email = $value->email;
		    $kurir = $value->kurir;
		    $ongkir = $value->ongkir;
		    $fullname = $value->fullname;
		    $phone = $value->phone;
		    $alamat = $value->alamat;
		    $etd = $value->etd;
		    $kode_unik = $value->kode_unik;
		    $id = $value->id;
		    $bank_name = $value->bank_name;
		    $stockist_commission = $value->stockist_commission;
		    $bank_number = $value->bank_number;
		    $total = $value->total;		    
          	$sell_price = $value->sell_price;          	
          	$amount = $value->amount;          	
          	$ongkir_produk = $value->ongkir_produk;



		    if(!in_array($value->user_id, $unique_array))
		    {
		            array_push($unique_array, $fid_value);
		            array_push($inner_array, $value);
		           
		            $outer_array[$fid_value]['user_id'] = $fid_value;
		         
		          
		           
		            $outer_array[$fid_value]['username'] = $username;
		            $outer_array[$fid_value]['fullname'] = $fullname;
		            $outer_array[$fid_value]['id'] = $id;
		            $outer_array[$fid_value]['phone'] = $phone;
		            $outer_array[$fid_value]['stockist_commission'] = $stockist_commission;
		            $outer_array[$fid_value]['alamat'] = $alamat;
		            $outer_array[$fid_value]['email'] = $email;
		            $outer_array[$fid_value]['kurir'] = $kurir;
		            $outer_array[$fid_value]['etd'] = $etd;
		            $outer_array[$fid_value]['ongkir'] = $ongkir;
		            $outer_array[$fid_value]['kode_unik'] = $kode_unik;
              
		            $outer_array[$fid_value]['bank'] = "{$bank_name} - {$bank_number} ";
		            $outer_array[$fid_value]['products'] = $inner_array;
		           
		    }else{		            
		            array_push($outer_array[$fid_value]['products'], $value);
		           	$outer_array[$fid_value]['stockist_commission'] += $stockist_commission;
		
		            
		         
		    }
		}
		$data['detail_orders'] = $outer_array;

		$data['transaksi_id'] = $id;

		$data['address'] = $this->address->where('user_id', user()->id)->where('type','distributor')->first();

		return view('db_stokis/detail_order', $data);
		
	}

	public function print($id)
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}

		$data['detail_orders'] = $this->transaksi
		->select('*, transaksi.total as total_transaksi, detailtransaksi.id as id, detailtransaksi.stockist_commission')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("bills", 'bills.id = bill_id')
		->join("users", 'users.id = transaksi.user_id')
		->join("cart_item", 'cart_item.id = cart_id')
		->join('distributor', 'distributor.id = cart_item.distributor_id', 'left')
		->join("products", 'products.id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('detailtransaksi.transaksi_id', $id)->where('distributor.user_id', user()->id)->findAll();
		
      
      $data['total_transaksi'] = $this->transaksi
		->select('*, sum(COALESCE(detailtransaksi.stockist_commission, 0) + COALESCE(detailtransaksi.admin_commission, 0) + COALESCE(detailtransaksi.affiliate_commission, 0)) as total_transaksi, distributor.id as id')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("bills", 'bills.id = bill_id')
		->join("users", 'users.id = transaksi.user_id')
		->join("cart_item", 'cart_item.id = cart_id')
		->join('distributor', 'distributor.id = detailtransaksi.distributor_id', 'left')
		->join("products", 'products.id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('detailtransaksi.transaksi_id', $id)->where('distributor.user_id', user()->id)->findAll();
		      
		$outer_array = array();
		$unique_array = array();

		foreach($data['detail_orders'] as $key => $value)
		{

		    $inner_array = array();

		    $fid_value = $value->user_id;
		  
		    $username = $value->username;
		    $email = $value->email;
		    $kurir = $value->kurir;
		    $ongkir = $value->ongkir;
		    $fullname = $value->fullname;
		    $phone = $value->phone;
		    $alamat = $value->alamat;
		    $etd = $value->etd;
		    $kode_unik = $value->kode_unik;
		    $id = $value->id;
		    $bank_name = $value->bank_name;
		    $stockist_commission = $value->stockist_commission;
		    $bank_number = $value->bank_number;
		    $total = $value->total;		    
          	$sell_price = $value->sell_price;          	
          	$amount = $value->amount;          	
          	$ongkir_produk = $value->ongkir_produk;



		    if(!in_array($value->user_id, $unique_array))
		    {
		            array_push($unique_array, $fid_value);
		            array_push($inner_array, $value);
		           
		            $outer_array[$fid_value]['user_id'] = $fid_value;
		         
		          
		           
		            $outer_array[$fid_value]['username'] = $username;
		            $outer_array[$fid_value]['fullname'] = $fullname;
		            $outer_array[$fid_value]['id'] = $id;
		            $outer_array[$fid_value]['phone'] = $phone;
		            $outer_array[$fid_value]['stockist_commission'] = $stockist_commission;
		            $outer_array[$fid_value]['alamat'] = $alamat;
		            $outer_array[$fid_value]['email'] = $email;
		            $outer_array[$fid_value]['kurir'] = $kurir;
		            $outer_array[$fid_value]['etd'] = $etd;
		            $outer_array[$fid_value]['ongkir'] = $ongkir;
		            $outer_array[$fid_value]['kode_unik'] = $kode_unik;
              
		            $outer_array[$fid_value]['bank'] = "{$bank_name} - {$bank_number} ";
		            $outer_array[$fid_value]['products'] = $inner_array;
		           
		    }else{		            
		            array_push($outer_array[$fid_value]['products'], $value);
		           	$outer_array[$fid_value]['stockist_commission'] += $stockist_commission;
		
		            
		         
		    }
		}
		$data['detail_orders'] = $outer_array;

		$data['transaksi_id'] = $id;

		$data['address'] = $this->address->where('user_id', user()->id)->where('type','distributor')->first();
		
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$dompdf->loadHtml(view('db_stokis/pdf', $data));

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser

        $dompdf->stream('transaksi.pdf', array('Attachment'=>2));

		return redirect()->back();
		
	}

	public function order_detail($id)
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		$data['detail_orders'] = $this->transaksi
		->select('*, transaksi.total as total_transaksi, detailtransaksi.id as id')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("bills", 'bills.id = bill_id')
		->join("users", 'users.id = transaksi.user_id')
		->join("cart_item", 'cart_item.id = cart_id')
		->join('distributor', 'distributor.id = cart_item.distributor_id', 'left')
		->join("products", 'products.id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('detailtransaksi.transaksi_id', $id)->findAll();
		
		$outer_array = array();
		$unique_array = array();

		foreach($data['detail_orders'] as $key => $value)
		{

		    $inner_array = array();

		    $fid_value = $value->user_id;
		  
		    $fullname = $value->fullname;
		    $phone = $value->phone;
		    $alamat = $value->alamat;
		    $email = $value->email;
		    $kurir = $value->kurir;
		    $ongkir = $value->ongkir_produk;
		    $etd = $value->etd;
		    $kode_unik = $value->kode_unik;
		    $bank_name = $value->bank_name;
		    $bank_number = $value->bank_number;
		    $status_pembayaran = $value->status_pembayaran;
		    $total_transaksi = $value->total_transaksi;
		 

		    if(!in_array($value->user_id, $unique_array))
		    {
		            array_push($unique_array, $fid_value);
		            array_push($inner_array, $value);
		           
		            $outer_array[$fid_value]['user_id'] = $fid_value;
		           
		            $outer_array[$fid_value]['alamat'] = $alamat;
		           
		           
		            $outer_array[$fid_value]['fullname'] = $fullname;
		            $outer_array[$fid_value]['phone'] = $phone;
		            $outer_array[$fid_value]['kode_unik'] = $kode_unik;
		            $outer_array[$fid_value]['email'] = $email;
		            $outer_array[$fid_value]['kurir'] = $kurir;
		            $outer_array[$fid_value]['etd'] = $etd;
		            $outer_array[$fid_value]['ongkir'] = $ongkir;
		            $outer_array[$fid_value]['status_pembayaran'] = $status_pembayaran;
		            $outer_array[$fid_value]['total_transaksi'] = $total_transaksi;
		            $outer_array[$fid_value]['bank'] = "{$bank_name} - {$bank_number} ";
		            $outer_array[$fid_value]['products'] = $inner_array;
		           

		    }else{		            
		            array_push($outer_array[$fid_value]['products'], $value);
		            $outer_array[$fid_value]['ongkir'] += $ongkir;


		         
		    }
		}
		$data['detail_orders'] = $outer_array;

		$data['transaksi_id'] = $id;

		return view('db_admin/order/order_detail', $data);
		
	}



	// public function member_admin()
	// {
		
	// 	// $data['data'] = $this->user->findAll();
	// 	// $user = $this->user->select('id, email');
	// 	$db = db_connect();
	// 	$users = $db->table('users');

	// 	$users->select('users.id, users.email, users.username, users.active, auth_groups_users.group_id, auth_groups.name AS role');
	// 	$users->join('auth_groups_users', 'auth_groups_users.user_id=users.id');
	// 	$users->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id');
	// 	$users->where('auth_groups.name !=', 'user');
	// 	$users->where('auth_groups.name !=', 'affiliate');
	// 	$users->where('auth_groups.name !=', 'stockist');
	// 	$getUsers['users'] = $users->get()->getResultArray();

	// 	return view('db_admin/members/member_admin', $getUsers);
	// }

	public function member_distributor()
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		$data['distributor']=$this->distributor->select('*,distributor.id as id')
		->join('users', 'distributor.user_id=users.id','inner')
		->orderBy('level','ASC')
		->findAll();

		if ($this->request->getPost('locate')!=null) {
			$data['distributor']=$this->distributor->select('*,distributor.id as id')
			->join('users', 'distributor.user_id=users.id','inner')
			->like('locate',$this->request->getPost('locate'))
			->orderBy('level','ASC')
			->findAll();
			}

		$data['pager'] = $this->transaksi->paginate(10, 'distributor');
		$data['pager'] = $this->transaksi->pager;
		
		return view('db_admin/members/member_distributor',$data);
	}

	public function add_member()
	{
		return view('db_admin/members/add_member');
	}


	public function order_search()
	{
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}
		$keyword = $this->request->getPost('keyword');	
		$status = $this->request->getPost('status');	
		if($status){
			
			$data['orders'] = $this->transaksi->select("*, GROUP_CONCAT(detailtransaksi.status_barang) as status_barang, transaksi.id as id, transaksi.created_at")
			->join('users', 'users.id = transaksi.user_id', 'left')
			->join('detailtransaksi', 'detailtransaksi.transaksi_id = transaksi.id', 'left')
			->groupBy('detailtransaksi.transaksi_id')
			->like('transaksi.status_pembayaran', $status)
			->orderBy('transaksi.id', 'DESC')->find();

			$data['pager'] = $this->transaksi->paginate(5, 'orders');
			$data['pager'] = $this->transaksi->pager;
			return view('db_admin/order/order', $data);
		}

		$data['orders'] = $this->transaksi->select("*, transaksi.id as id, transaksi.created_at")
		->join('users', 'users.id = transaksi.user_id', 'left')
		->like('users.fullname', $keyword)
		->orderBy('transaksi.id', 'DESC')->find();

		$data['pager'] = $this->transaksi->paginate(5, 'orders');
		$data['pager'] = $this->transaksi->pager;
		return view('db_admin/order/order', $data);
	}

	public function empty()
	{
		if(in_groups(1)){
			$db = \Config\Database::connect();
			$forge = \Config\Database::forge();
			$db->table('detailtransaksi')->truncate();
			$db->table('transaksi')->truncate();
			$db->table('pengiriman')->truncate();
			$db->table('detailpengiriman')->truncate();
			$db->table('pengiriman')->truncate();
			$db->table('bills')->truncate();
			$db->table('cart_item')->truncate();
			$db->table('upgrades')->truncate();
			$db->table('pendapatan')->truncate();
			$db->table('penarikan_dana')->truncate();
			$db->table('konfirmasi')->truncate();
		}
		
		return redirect()->to('/admin');
	}

	public function kosong()
	{
		
		return view('db_admin/kosong');
	}

	public function admin_konfirmasi(){
		$data['konfirmasi'] = $this->konfirmasi
		->select('konfirmasi.id as id ,users.fullname as name,konfirmasi.date as date,konfirmasi.total as total,konfirmasi.bill as bill,konfirmasi.transaksi_id as transaksi_id,konfirmasi.keterangan as keterangan,konfirmasi.bill as bill')
		->join('users', 'users.id=konfirmasi.user_id', 'left')
		->orderBy('id','DESC')
		->find();
		if ($this->request->getPost('name')!=null) {
			$data['konfirmasi'] = $this->konfirmasi
			->select('konfirmasi.id as id ,users.fullname as name,konfirmasi.date as date,konfirmasi.total as total,konfirmasi.bill as bill,konfirmasi.transaksi_id as transaksi_id,konfirmasi.keterangan as keterangan,konfirmasi.bill as bill')
			->join('users', 'users.id=konfirmasi.user_id', 'left')
			->like('users.fullname',$this->request->getPost('name'))
			->orderBy('id','DESC')
			->find();
		}

		return view('db_admin/order/konfirmasi',$data);
	}

	public function delete_konfirmasi($id){
		$this->konfirmasi->delete($id);

		return redirect()->back();
	}

	public function sosial(){

		if ($this->request->getPost('name')!=null) {
			$set=[
				'name'=>$this->request->getPost('name'),
				'link'=>$this->request->getPost('link'),
			];
			$this->sosial->save($set);
		}
		$data['sosial']=$this->sosial->findAll();
		return view('db_admin/banner/sosial',$data);
	}

	public function delete_sosial($id){
		
		$this->sosial->delete($id);

		return redirect()->back();
	}


	public function api($status)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('api_key');

		if($status == 'add'){
			$nama = $this->request->getPost('nama');
			$token = $this->request->getPost('token');

			$data = [
				"name" => $nama,
				"token" => $token
			];

			$builder->insert($data);
			return redirect()->back();

		}
		if($status == 'edit'){

			$nama = $this->request->getPost('nama');
			$token = $this->request->getPost('token');
			$id = $this->request->getPost('id');

			$data = [
				"name" => $nama,
				"token" => $token
			];

			$builder->where("id", $id);
			$builder->update($data);

			$data['apis'] = $builder->get()->getResult();

			return view("db_admin/api/api_key", $data);
		}

		$data['apis'] = $builder->get()->getResult();

		return view("db_admin/api/api_key", $data);
		
	}

	public function api_edit($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('api_key');

		$data['apis'] = $builder->where('id', $id)->get()->getResultObject()[0];

		return view("db_admin/api/edit_api", $data);
	}

	public function api_delete($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('api_key');

		$builder->delete(["id" => $id]);

		return redirect()->back();
	}




	// setting wd



	public function wd($status)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('setting_wd');

		if($status == 'add'){
			$minimal = $this->request->getPost('minimal');

			$data = [
				"minimal" => $minimal
			];

			$builder->insert($data);
			return redirect()->back();

		}
		if($status == 'edit'){

			$minimal = $this->request->getPost('minimal');
			$id = $this->request->getPost('id');

			$data = [
				"minimal" => $minimal,
			];

			$builder->where("id", $id);
			$builder->update($data);

			$data['settings'] = $builder->get()->getResult();

			return view("db_admin/wd/wd", $data);
		}

		$data['settings'] = $builder->get()->getResult();

		return view("db_admin/wd/wd", $data);
		
	}

	public function wd_edit($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('setting_wd');

		$data['setting'] = $builder->where('id', $id)->get()->getResultObject()[0];

		return view("db_admin/wd/edit_wd", $data);
	}

	public function wd_delete($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('setting_wd');

		$builder->delete(["id" => $id]);

		return redirect()->back();
	}


	// setting Affiliate

	public function setting_affiliate($status)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('setting_affiliate');

		if($status == 'add'){
			$minimal = $this->request->getPost('minimal');

			$data = [
				"minimal" => $minimal
			];

			$builder->insert($data);
			return redirect()->back();

		}
		if($status == 'edit'){

			$minimal = $this->request->getPost('minimal');
			$id = $this->request->getPost('id');

			$data = [
				"minimal" => $minimal,
			];

			$builder->where("id", $id);
			$builder->update($data);

			$data['settings'] = $builder->get()->getResult();

			return view("db_admin/affiliate/setting_affiliate", $data);
		}

		$data['settings'] = $builder->get()->getResult();

		return view("db_admin/affiliate/setting_affiliate", $data);
		
	}

	public function affiliate_edit($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('setting_affiliate');

		$data['setting'] = $builder->where('id', $id)->get()->getResultObject()[0];

		return view("db_admin/affiliate/edit_affiliate", $data);
	}

	public function affiliate_delete($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('setting_affiliate');

		$builder->delete(["id" => $id]);

		return redirect()->back();
	}

}
