<?php

namespace App\Controllers;
use Myth\Auth\Models\UserModel;

class Member extends BaseController
{

	public function __construct(){

		$this->user = new  UserModel();
	}
	public function index()
	{
		
		// $data['data'] = $this->user->findAll();
		// $user = $this->user->select('id, email');

		// $data['users'] = $this->user->paginate(10, 'users');
		// $this->

		// $users = new UserModel();
		// dd($users->findAll());

		$db = \Config\Database::connect();
		$users = $db->table('users');

		$users->select('users.id, users.email, users.username, users.active, auth_groups_users.group_id, auth_groups.name AS role');
		$users->join('auth_groups_users', 'auth_groups_users.user_id=users.id');
		$users->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id');
		$users->where('auth_groups.name !=', 'user');
		$users->where('auth_groups.name !=', 'affiliate');
		$users = $users->get();


		// $data['users'] = $this->user->paginate(5, 'users');
		$data['users'] = $users->getResult('object');

		// dd($data['users']);
		$data['pager'] = $this->user->pager;

		// dd($data['users']);

		// dd($this->user->paginate(2, 5));
		// $db = db_connect();
		// $users = $db->table('users');

		// $users->select('users.id, users.email, users.username, users.active, auth_groups_users.group_id, auth_groups.name AS role');
		// $users->join('auth_groups_users', 'auth_groups_users.user_id=users.id');
		// $users->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id');
		// $users->where('auth_groups.name !=', 'user');
		// $users->where('auth_groups.name !=', 'affiliate');
		// $users->where('auth_groups.name !=', 'stockist');
		// $users->get();
		// $users->paginate(2);
		// $getUsers['users'] = $users->paginate(2);


		return view('db_admin/members/member_admin', $data);
	}

	public function search()
	{
		$db = db_connect();
		$users = $db->table('users');

		$keyword = $this->request->getPost('keyword');

		$users->select('users.id, users.email, users.username, users.active, auth_groups_users.group_id, auth_groups.name AS role');
		$users->join('auth_groups_users', 'auth_groups_users.user_id=users.id');
		$users->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id');
		$users->where('auth_groups.name !=', 'user');
		$users->like(['username' => $keyword]);
		$getUsers['users'] = $users->get()->getResultArray();

		return view('db_admin/members/member_admin', $getUsers);
	}
}
