<?php

namespace App\Controllers;
use Myth\Auth\Models\UserModel;
use App\Models\RekeningModel;
use App\Models\SosialModel;
class Member extends BaseController
{
	protected $user;
	protected $datauser;

	public function __construct(){
		$this->sosial = new SosialModel();
		$this->data['sosial']    = $this->sosial->findAll();
		$this->rekening = new  RekeningModel();
		$this->user = new  UserModel();
		$this->datauser=[];

	}
	public function index()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		// $data['data'] = $this->user->findAll();
		// $user = $this->user->select('id, email');

		// $data['users'] = $this->user->paginate(10, 'users');
		// $this->

		// $users = new UserModel();
		// dd($users->findAll());

		$db = \Config\Database::connect();
		$users = $db->table('users');

		$users->select('users.id, users.email, users.username,users.phone, users.active');
		$users->join('auth_groups_users', 'auth_groups_users.user_id=users.id');
		$users->join('auth_groups', 'auth_groups_users.group_id=auth_groups.id');
		$users->groupBy('users.id');
		if ($this->request->getPost('role') != null) {
			$users->like('auth_groups.name', $this->request->getPost('role'));
		}
		if ($this->request->getPost('name') != null) {
			$users->like('users.username', $this->request->getPost('name'));
		}
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


	public function affiliate()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data['affiliate'] = $this->user->where('affiliate_link !=', null)->findAll();

		$data['pager'] = $this->user->paginate(5, 'affiliates');
		$data['pager'] = $this->user->pager;
		return view('db_admin/members/member_affiliate', $data);
	}

	public function search()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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

	public function detail($id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data['user'] = $this->user
		->where('users.id',$id)
		->first();
		
		$data['roles'] = $this->user->select('auth_groups.id,auth_groups.name')
		->join('auth_groups_users', 'auth_groups_users.user_id=users.id')
		->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id')
		->where('users.id',$id)->findAll();

		$db = \Config\Database::connect();
		$group = $db->table('auth_groups')->select('*');

		$data['rekening'] = $this->rekening->where('user_id',$id)->find();

		$data['group']= $group->get()->getResultArray();

		return view('db_admin/members/detail_member', $data);
	}

	public function deleteRole($id,$role)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$db = db_connect();
		$data = $db->table('auth_groups_users');
		$r = $db->table('auth_groups')->where('name',$role)->get()->getResultArray();
		$data->where('group_id',$r[0]['id'])->where('user_id',$id)->delete();

		return redirect()->back();
	}

	public function deleteUser($id)
	{
		$db = db_connect();
		$data = $db->table('users');
		$data->where('id',$id)->delete();

		return redirect()->back();
	}

	public function addRole($id)
	{
		$db = db_connect();
		$data = $db->table('auth_groups_users');
		$set=[
			'user_id'=>$id,
			'group_id'=>$this->request->getPost('role')
		];
		$data->insert($set);

		return redirect()->back();
	}

	public function activeUser($id){
		$db = db_connect();
		$data = $db->table('users');
		$data->where('id',$id)->update(['active'=>1]);
		return redirect()->back();	
	}
	public function nonActiveUser($id){
		$db = db_connect();
		$data = $db->table('users');
		$data->where('id',$id)->update(['active'=>0]);
		return redirect()->back();	
	}

	public function jaringan()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$user = [];

		$user=$this->user_rekursif(user()->id);
		if (user()->parent!=null) {
			$data['sponsor'] = $this->user->where('id',user()->parent)->first();
		}else{
			$data['sponsor'] = $this->user
			->select("users.fullname as fullname,users.created_at as created_at,ag.name as role,users.phone as phone")
			->join("auth_groups_users as agu", "agu.user_id=users.id")
			->join("auth_groups as ag", "agu.group_id=ag.id")
			->orderBy('ag.id',"ASC")
			->where('users.id',user()->id)->first();
		}
		
		$data['users'] = $this->datauser;
		return view('db_admin/members/jaringan', $data);
	}

	public function user_rekursif($parent=null){
			$model = $this->user;
			$data = $model->where('parent',$parent)->find();
				foreach ($data as $key => $value) {
					$data = $this->user
					->select("users.username as username,users.created_at as created_at,ag.name as role,users.phone as phone")
					->join("auth_groups_users as agu", "agu.user_id=users.id")
					->join("auth_groups as ag", "agu.group_id=ag.id")
					->orderBy('ag.id',"ASC")
					->where('users.id',$value->id)->first();
					array_push($this->datauser,$data);
					$this->user_rekursif($value->id);
				}
	}
}

