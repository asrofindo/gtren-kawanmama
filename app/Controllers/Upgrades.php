<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UpgradesModel;
use App\Models\UniqueCodeModel;
use App\Models\GenerateModel;
use App\Models\DistributorModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Authorization\GroupModel;

class upgrades extends BaseController
{

	public function __construct()
	{
		$this->model = new UpgradesModel();
		$this->user = new UserModel();
		$this->uniq = new UniqueCodeModel();
		$this->generate = new GenerateModel();
		$this->distributor = new DistributorModel();
		$this->group = new GroupModel();
		$this->db      = \Config\Database::connect();
		$this->builder = $this->db->table('auth_groups_users');
	}

	public function index()
	{
		$this->model->select('status_request, type, code, photo, total, bill');
		$this->model->select('users.username, users.affiliate_link, users.id as id_user, upgrades.user_id as id');
		$this->model->join('users', 'users.id = upgrades.user_id', 'left');
		$data['upgrades'] = $this->model->paginate(4, 'upgrades');
		$data['pager'] = $this->model->pager;
		return view('db_admin/upgrades/upgrades', $data);
	}

	public function save($id)
	{
		$request = $this->request;

		if($this->model->where('user_id', $id)->find()){
			session()->setFlashdata('success', 'Menunggu persetujuan Admin');
			return redirect()->back();
		}
		if($request->getPost('type') == 'affiliate')
		{

			$data = [
				'user_id' => user()->id,
				'code' => $request->getPost('code'),
				'status_request' => 'pending',
				'type' => $request->getPost('type'),
				'total' => $request->getPost('total'),
				'bill' => $request->getPost('bill'),
				'photo' => null
			];

			$generate = $this->generate->find()[0]['nomor'];

			$this->generate->save(['id' => 1, 'nomor' => $generate + 1]);

		} else {

			$code = $request->getPost('code');
			$username = $request->getPost('username');
			$unique_id = $this->uniq->where('code', $code)->find();
			$unique_username = $this->uniq->where('username', $username)->find();

			if(!$unique_id && !$unique_username)
			{	
				session()->setFlashdata('danger', 'Code Salah');
				return redirect()->back();
			} 

			if($unique_id[0]->used > 0)
			{	
				session()->setFlashdata('danger', 'Code Sudah Digunakan');
				return redirect()->back();
			} 


			$this->group->addUserToGroup(user()->id, 3);
			$this->group->addUserToGroup(user()->id, 4);
			$this->distributor->save(['user_id' => user()->id, 'locate' => null]);
			$this->uniq->save(["id" => $unique_id[0]->id, "used" => user()->id]);

			session()->setFlashdata('successs', 'Berhasil, Anda Sekarang Adalah Stockist');
			return redirect()->back();


		}


		if(!$this->model->save($data)){
			session()->setFlashdata('danger', 'Terjadi Kesalahan');
	        return redirect()->back();
		} 

		session()->setFlashdata('success', 'Data Berhasil Disimpan Tunggu Konfirmasi Dari Admin');
		return redirect()->back();
	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);
		if(!$delete){
			$delete['upgrades'] = $this->model->findAll();
			$delete['errors']     = $this->model->errors();
	        return view('db_admin/upgrades/upgrades', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Dihapus');

		return redirect()->to(base_url('/upgrades'));

	}

	public function edit($id)
	{
		$data['upgrades'] = $this->model->find($id);
		
		return view('db_admin/upgrades/edit_upgrades', $data);

	}

	public function update($id)
	{
		
		$request = $this->request;
		$this->group->addUserToGroup($id, 4);

		$data = [
			'status_request' => 'active'
		];


		$upgrades = $this->db->table('upgrades');
		$upgrades->where('user_id', $id);
		$upgrades->update($data);

		$users = $this->db->table('users');
		$users->where('id', $id);
		$users->update(['affiliate_link' => base_url('/src/'. $id)]);
		


		$data['upgrades'] = $this->model->findAll();
	
		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->to(base_url('/upgrades'));

	}


	public function search()
	{
		$keyword            = $this->request->getPost('keyword');
		$this->model->select('status_request, type, code, photo');
		$this->model->select('users.username, users.id as id_user, upgrades.user_id as id');
		$this->model->join('users', 'users.id = upgrades.user_id', 'left');
		$data['upgrades'] = $this->model->like(['username' => $keyword])->paginate(2, 'upgrades');
		$data['pager'] = $this->model->pager;

		return view('db_admin/upgrades/upgrades', $data);;
	}

	public function upload($id){
		$file = $this->request->getFile('photo');

		$new_name = $file->getRandomName();

		$file->move(ROOTPATH . 'public/uploads/bukti', $new_name);

		$data = [
			"photo" => $new_name
		];
		
		$upgrades = $this->db->table('upgrades');
		$upgrades->where('user_id', $id);

		if(!$upgrades->update($data))
		{
			session()->setFlashdata('danger', 'Data Gagal Di Upload');
			return redirect()->back();
		}

		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->back();

	}
}
