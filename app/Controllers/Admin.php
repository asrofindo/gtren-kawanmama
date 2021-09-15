<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use Myth\Auth\Models\UserModel;
use App\Models\TransaksiModel;
use App\Models\DistributorModel;
use App\Models\NotifModel;
use App\Models\KonfirmasiModel;

use Myth\Auth\Authorization\GroupModel;

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

		$this->distributor = new DistributorModel();
		$this->notif = new NotifModel();


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
				'phone'=>$this->request->getPost('phone'),
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

		$data['orders'] = $this->transaksi->select('*, transaksi.id as id,transaksi.created_at')
		->join('users', 'users.id = transaksi.user_id', 'left')
		->orderBy('transaksi.id', 'DESC')
		->find(); 

		$data['pager'] = $this->transaksi->paginate(5, 'orders');
		$data['pager'] = $this->transaksi->pager;
		return view('db_admin/order/order', $data);

	}

	public function order_stockist()
	{
		$id = user()->id;
		$data['orders'] = $this->transaksi
		->select('*, transaksi.total as total_transaksi, transaksi.id as id, detailtransaksi.id as detail_id, transaksi.created_at as created_at')
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

		$data['pager'] = $this->transaksi->paginate(5, 'orders');
		$data['pager'] = $this->transaksi->pager;
		return view('db_stokis/order', $data);
	}

	// order detaiil stockist
	public function order_detail_stockist($id)
	{

		$data['detail_orders'] = $this->transaksi
		->select('*, transaksi.total as total_transaksi, detailtransaksi.id as id')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("bills", 'bills.id = bill_id')
		->join("users", 'users.id = transaksi.user_id')
		->join("cart_item", 'cart_item.id = cart_id')
		->join('distributor', 'distributor.id = cart_item.distributor_id', 'left')
		->join("products", 'products.id = cart_item.product_id')
		->join("address", 'address.user_id = transaksi.user_id AND address.type = "billing"')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('detailtransaksi.transaksi_id', $id)->where('distributor.user_id', user()->id)->findAll();

		$outer_array = array();
		$unique_array = array();

		foreach($data['detail_orders'] as $key => $value)
		{

		    $inner_array = array();

		    $fid_value = $value->user_id;
		    $kecamatan = $value->kecamatan;
		    $username = $value->username;
		    $email = $value->email;
		    $kurir = $value->kurir;
		    $ongkir = $value->ongkir;
		    $fullname = $value->fullname;
		    $phone = $value->phone;
		    $alamat = $value->alamat;
		    $etd = $value->etd;
		    $kabupaten = $value->kabupaten;
		    $kode_pos = $value->kode_pos;
		    $bank_name = $value->bank_name;
		    $bank_number = $value->bank_number;
		    $total_transaksi = $value->total_transaksi;
		 

		    if(!in_array($value->user_id, $unique_array))
		    {
		            array_push($unique_array, $fid_value);
		            array_push($inner_array, $value);
		           
		            $outer_array[$fid_value]['user_id'] = $fid_value;
		            $outer_array[$fid_value]['kecamatan'] = $kecamatan;
		            $outer_array[$fid_value]['kabupaten'] = $kabupaten;
		            $outer_array[$fid_value]['kode_pos'] = $kode_pos;
		            $outer_array[$fid_value]['username'] = $username;
		            $outer_array[$fid_value]['fullname'] = $fullname;
		            $outer_array[$fid_value]['phone'] = $phone;
		            $outer_array[$fid_value]['alamat'] = $alamat;
		            $outer_array[$fid_value]['email'] = $email;
		            $outer_array[$fid_value]['kurir'] = $kurir;
		            $outer_array[$fid_value]['etd'] = $etd;
		            $outer_array[$fid_value]['ongkir'] = $ongkir;
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

		return view('db_stokis/detail_order', $data);
		
	}

	public function order_detail($id)
	{

		$data['detail_orders'] = $this->transaksi
		->select('*, transaksi.total as total_transaksi, detailtransaksi.id as id')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("bills", 'bills.id = bill_id')
		->join("users", 'users.id = transaksi.user_id')
		->join("cart_item", 'cart_item.id = cart_id')
		->join('distributor', 'distributor.id = cart_item.distributor_id', 'left')
		->join("products", 'products.id = cart_item.product_id')
		->join("address", 'address.user_id = transaksi.user_id AND address.type = "billing"')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->where('detailtransaksi.transaksi_id', $id)->findAll();

		$outer_array = array();
		$unique_array = array();

		foreach($data['detail_orders'] as $key => $value)
		{

		    $inner_array = array();

		    $fid_value = $value->user_id;
		    $kecamatan = $value->kecamatan;
		    $fullname = $value->fullname;
		    $phone = $value->phone;
		    $alamat = $value->alamat;
		    $email = $value->email;
		    $kurir = $value->kurir;
		    $ongkir = $value->ongkir;
		    $etd = $value->etd;
		    $kabupaten = $value->kabupaten;
		    $kode_pos = $value->kode_pos;
		    $bank_name = $value->bank_name;
		    $bank_number = $value->bank_number;
		    $status_pembayaran = $value->status_pembayaran;
		    $total_transaksi = $value->total_transaksi;
		 

		    if(!in_array($value->user_id, $unique_array))
		    {
		            array_push($unique_array, $fid_value);
		            array_push($inner_array, $value);
		           
		            $outer_array[$fid_value]['user_id'] = $fid_value;
		            $outer_array[$fid_value]['kecamatan'] = $kecamatan;
		            $outer_array[$fid_value]['alamat'] = $alamat;
		            $outer_array[$fid_value]['kabupaten'] = $kabupaten;
		            $outer_array[$fid_value]['kode_pos'] = $kode_pos;
		            $outer_array[$fid_value]['fullname'] = $fullname;
		            $outer_array[$fid_value]['phone'] = $phone;
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
		$data['distributor']=$this->distributor->select('*,distributor.id as id')
		->join('users', 'distributor.user_id=users.id','inner')
		->orderBy('level','ASC')
		->findAll();

		if ($this->request->getPost('locate')!=null) {
			$data['distributor']=$this->distributor->select('*,distributor.id as id')
			->join('users', 'distributor.user_id=users.id','inner')
			->where('locate','ASC')
			->orderBy('level','ASC')
			->findAll();		}

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
		$keyword = $this->request->getPost('keyword');	
		$status = $this->request->getPost('status');	
		if($status){
			
			$data['orders'] = $this->transaksi->select("*, transaksi.id as id, transaksi.created_at")
			->join('users', 'users.id = transaksi.user_id', 'left')
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
		}
		
		return redirect()->to('/admin');
	}

	public function admin_konfirmasi(){
		$data['konfirmasi'] = $this->konfirmasi
		->select('konfirmasi.id as id ,users.fullname as name,konfirmasi.date as date,konfirmasi.total as total,konfirmasi.bill as bill,konfirmasi.transaksi_id as transaksi_id,konfirmasi.keterangan as keterangan')
		->join('users', 'users.id=konfirmasi.user_id', 'left')
		->find();

		return view('db_admin/order/konfirmasi',$data);
	}

	public function delete_konfirmasi($id){
		$this->konfirmasi->delete($id);

		return redirect()->back();
	}

}
