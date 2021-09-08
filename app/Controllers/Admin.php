<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use Myth\Auth\Models\UserModel;
use App\Models\TransaksiModel;
use Myth\Auth\Authorization\GroupModel;

class Admin extends BaseController
{
	public $model;
	public $transaksi;


	public function __construct()

	{
		$this->user = new UserModel();
		$this->transaksi = new TransaksiModel();

	}
	public function index()
	{
		return view('db_admin/produk/tambah_produk');
	}
	
	public function produk_list()
	{
		
		return view('db_admin/produk/produk_list');
	}
	
	public function order()
	{
		$data['orders'] = $this->transaksi->select('*, transaksi.id as id,distributor.locate as distributor,transaksi.created_at')
		->join('users', 'users.id = transaksi.user_id', 'left')
		->join('distributor', 'distributor.user_id = users.id', 'left')
		->find(); 
		$data['pager'] = $this->transaksi->paginate(5, 'orders');
		$data['pager'] = $this->transaksi->pager;
		return view('db_admin/order/order', $data);
		$data['orders']= $this->transaksi->select('transaksi.id as id,users.username as name,users.email as email,transaksi.total as total,transaksi.created_at as created_at,transaksi.status_pembayaran as status')
		->join('users', 'users.id = transaksi.user_id','inner')
		->orderBy('transaksi.created_at', 'DESC')
		->findAll();
		return view('db_admin/order/order',$data);
	}

	public function order_stockist()
	{
		$id = user()->id;
		$data['orders'] = $this->transaksi
		->select('*, transaksi.total as total_transaksi, detailtransaksi.id as id')
		->join("detailtransaksi", "detailtransaksi.transaksi_id = transaksi.id", 'left')
		->join("cart_item", 'cart_item.id = cart_id')
		->join("products", 'products.id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id', 'left outer')
		->join('pengiriman', 'pengiriman.id = detailpengiriman.pengiriman_id', 'left outer')
		->join('distributor', 'distributor.id = cart_item.distributor_id')
		->where('distributor.user_id', user()->id)
		->findAll();

		$data['pager'] = $this->transaksi->paginate(5, 'orders');
		$data['pager'] = $this->transaksi->pager;
		return view('db_stokis/order', $data);
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
		    $username = $value->username;
		    $email = $value->email;
		    $kurir = $value->kurir;
		    $ongkir = $value->ongkir;
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

	public function member_finance()
	{
		return view('db_admin/members/member_finance');
	}

	public function add_member()
	{
		return view('db_admin/members/add_member');
	}

}
