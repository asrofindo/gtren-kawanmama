<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UpgradesModel;
use App\Models\UniqueCodeModel;
use App\Models\BillModel;
use App\Models\GenerateModel;
use App\Models\DistributorModel;
use Myth\Auth\Models\UserModel;
use App\Models\NotifModel;
use Myth\Auth\Authorization\GroupModel;
use App\Models\SosialModel;

class upgrades extends BaseController
{

	public function __construct()
	{
		$this->model = new UpgradesModel();
		$this->user = new UserModel();
		$this->notif = new NotifModel();
		$this->uniq = new UniqueCodeModel();
		$this->generate = new GenerateModel();
		$this->bill = new BillModel();
		$this->distributor = new DistributorModel();
		$this->group = new GroupModel();
		$this->db      = \Config\Database::connect();
		$this->builder = $this->db->table('auth_groups_users');
		$this->sosial = new SosialModel();
		$this->data['sosial']    = $this->sosial->findAll();
	}

	public function index()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$this->model->select('status_request, type, code, photo, upgrades.total, bill, bills.total as bill_total, bills.bank_name, bills.owner');
		$this->model->select('users.username, users.affiliate_link, users.id as id_user, upgrades.user_id as id');
		$this->model->join('users', 'users.id = upgrades.user_id', 'left');
		$this->model->join('bills', 'bills.id = upgrades.bill', 'outer left');
		$data['upgrades'] = $this->model->paginate(4, 'upgrades');
		$data['pager'] = $this->model->pager;
		return view('db_admin/upgrades/upgrades', $data);
	}

	public function save($id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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

			$bill = $this->bill->where('id',$request->getPost('bill'))->first();
			$total = $request->getPost('total');
			$msg=base_url()." \n\n".user()->greeting." ".user()->fullname."\n"."Registrasi Program Referal *menunggu pembayaran* \nTagihan Total: ".$total."\nRekening ".$bill->bank_name."-".$bill->bank_number."-".$bill->owner;

			wawoo(user()->phone,$msg);

			$msg="Selamat!\nAda *upgrade affiliate* di ".base_url()."\nNama affiliate: ".user()->greeting." ".user()->fullname."\nNo. Wa: ".user()->phone;
			
			$notif = $this->notif->findAll();
			foreach ($notif as $key => $value) {
				wawoo($value['phone'],$msg);
			}

			$generate = $this->generate->find()[0]['nomor'];
			// $this->generate->save(['id' => 1, 'nomor' => $generate + 1]);
			
		} else {

			$code = $request->getPost('code');
			$username = $request->getPost('username');
			$unique_id = $this->uniq->where('code', $code)->find();
			$unique_username = $this->uniq->where('username', $username)->find();

			if(!$unique_id || !$unique_username)
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
			$this->distributor->save(['user_id' => user()->id, 'locate' => $username]);
			$this->uniq->save(["id" => $unique_id[0]->id, "used" => user()->id]);

			$users = $this->db->table('users');
			$users->where('id', user()->id);
			$users->update(['affiliate_link' => '/src/'. user()->id]);
			
			$msg= base_url()." \n\n".user()->greeting." ".user()->fullname."\nAnda sekarang *Distributor* \nAkses Dasbor Distributor :".base_url('dashboard');

			wawoo(user()->phone,$msg);

			$msg="Selamat!\n".user()->greeting." ".user()->fullname." sudah jadi distributor di ".base_url()."\nNo. Wa: ".user()->phone;

			$notif = $this->notif->findAll();			
			foreach ($notif as $key => $value) {
				wawoo($value['phone'],$msg);
			}

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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data['upgrades'] = $this->model->find($id);
		
		return view('db_admin/upgrades/edit_upgrades', $data);

	}

	public function update($id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$bill_id = $this->model->where('user_id', $id)->first()->bill;
		$total = $this->model->where('user_id', $id)->first()->total;
		$total_bill = $this->bill->find($bill_id)->total;
		

		$this->bill->save([
			"id" => $bill_id,
			"total" => $total_bill + $total
		]);
		$bill = $this->bill->find($bill_id)->bank_name;
		$request = $this->request;
		// $this->group->addUserToGroup($id, 4);

		$user=$this->user->where('id',$id)->first();

		$msg=base_url()." \n\n".$user->greeting." ".$user->fullname."\nStatus Program Referal Anda *sudah aktif* \nAkses Halaman Affiliate :".base_url('upgrade/affiliate');

		wawoo(user()->phone,$msg);	
		
		$msg="Selamat!\n".base_url()."\nNama : ".user()->greeting." ".user()->fullname."\nNo. Wa: ".user()->phone."/nStatus Program Referal *sudah aktif*";
			
		$notif = $this->notif->findAll();
		foreach ($notif as $key => $value) {
			wawoo($value['phone'],$msg);
		}


		$data = [
			'status_request' => 'active'
		];

		$upgrades = $this->db->table('upgrades');
		$upgrades->where('user_id', $id);
		$upgrades->update($data);

		$users = $this->db->table('users');
		$users->where('id', $id);
		$users->update(['affiliate_link' => '/src/'. $id]);
		


		$data['upgrades'] = $this->model->findAll();
	
		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->to(base_url('/upgrades'));
	}


	public function search()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$keyword            = $this->request->getPost('keyword');
		$this->model->select('status_request, type, code, photo');
		$this->model->select('users.username, users.id as id_user, upgrades.user_id as id');
		$this->model->join('users', 'users.id = upgrades.user_id', 'left');
		$data['upgrades'] = $this->model->like(['username' => $keyword])->paginate(2, 'upgrades');
		$data['pager'] = $this->model->pager;

		return view('db_admin/upgrades/upgrades', $data);;
	}

	public function upload($id){
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		
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
