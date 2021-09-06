<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Authorization\GroupModel;

class Admin extends BaseController
{
	public $model;
	public $user;


	public function __construct()

	{
		$this->user = new UserModel();
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
		return view('db_admin/order/order');
	}

	public function order_detail()
	{
		return view('db_admin/order/order_detail');
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
