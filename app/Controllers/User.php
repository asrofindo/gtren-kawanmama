<?php

namespace App\Controllers;
use App\Models\AccountUpgradeModel;
use App\Models\AddressModel;
use App\Models\UpgradesModel;
use App\Models\GenerateModel;
use App\Models\BillModel;
=======

use App\Models\CategoryModel;

use Myth\Auth\Models\UserModel;

class User extends BaseController
{
	protected $data;

	public function __construct(){
		$this->address = new AddressModel();
		$this->upgrade = new UpgradesModel();


		$this->category = new CategoryModel();
		$this->data['category']    = $this->category->findAll();
		$this->User = new UserModel();
		$this->generate = new GenerateModel();
		$this->bill = new BillModel();
	}
	public function account()
	{

		helper(['greeting_helper', 'user']);

		$data = $this->data;
		$data['segments'] = $this->request->uri->getSegments();

		return view('commerce/account', $data);
	}

	public function orders()
	{
		$data = $this->data;

		$data['segments'] = $this->request->uri->getSegments();

		return view('commerce/account', $data);
	}

	public function tracking()
	{
		$data = $this->data;

		$data['segments'] = $this->request->uri->getSegments();

		$curl = curl_init();

		$url = "https://api.binderbyte.com/v1/list_courier?api_key=336e8e201c4c0bf28ff277c6251c50347d2646c3caffbd36ff865ec1e11743bf";
		
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$response        = curl_exec($curl);
		$set_to_array    = json_decode($response, TRUE);
		$data['couries'] = $set_to_array;
		return view('commerce/account', $data);
	}

	public function track()
	{
		$data = $this->data;

		$curl    = curl_init();
		$awb     = $this->request->getPost('awb');
		$courier = $this->request->getPost('courier');

		$url     = "https://api.binderbyte.com/v1/track?api_key=336e8e201c4c0bf28ff277c6251c50347d2646c3caffbd36ff865ec1e11743bf&courier={$courier}&awb={$awb}";

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$response      = curl_exec($curl);
		$set_to_array  = json_decode($response, TRUE);
		$data['track'] = $set_to_array;

		if($data['track']['status'] == 400){

			session()->setFlashdata('danger', 'Data Tidak Ditemukan');
			return redirect()->back();
		}

		$email = \Config\Services::email();

		// $email->setHeader('MIME-Version', '1.0; charset=utf-8');
		// $email->setHeader('Content-type', 'text/html');

		$email->setFrom('team@gtren.co.id', 'Gtren Team');
		$email->setTo(user()->email);
		// $email->setTo('pujiselamat6@gmail.com');
		// $email->setTo('m.hilmimubarok@gmail.com');

		$email->setSubject('Detail of ur track');

		$msg = view('track/index', $data);
		$email->setMessage($msg);

		if ($email->send()) {
			session()->setFlashdata('success', 'Sukses!. Silahkan cek email anda.');
			return redirect()->back();
		}
		else 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }

		// return view('track/index', $data);
		// return view('track/index');
	}

	public function address()
	{

		$data = $this->data;


	
		$data['segments'] = $this->request->uri->getSegments();

		
		$data['billing_address'] = $this->address->where('type', 'billing')->where('deleted_at', null)->where('user_id', user()->id)->get()->getResult();
		$data['shipping_address'] = $this->address->where('type', 'shipping')->where('deleted_at', null)->where('user_id', user()->id)->get()->getResult();


		// verif
		return view('commerce/account', $data);
	}

	public function profile()
	{
		$data = $this->data;

		$data['segments'] = $this->request->uri->getSegments();

		return view('commerce/account', $data);
	}

	public function set_profile()
	{
		$data = $this->data;

		helper(['user']);

		$request = $this->request;
		$data = [
			'password' => $request->getPost('password'),
			'username' => $request->getPost('username'),
			'fullname' => $request->getPost('fullname'),
			'email' => $request->getPost('email')
		];

		user()->setProfile($data);
	}

	public function upgrade_affiliate()
	{
		$data = $this->data;

		$data['segments'] = $this->request->uri->getSegments();
		$data['bills'] = $this->bill->findAll();
		$data['generate'] = $this->generate->find()[0]['nomor'];

		$data['upgrades'] = $this->upgrade->where('user_id', user()->id)->findAll();
		
		$user = $this->upgrade->where('user_id', user()->id)->find();


		if(in_groups(4))
		{
			session()->setFlashdata('success', 'Anda Adalah affiliate');
			return view('commerce/account', $data);
		}
		
		if(count($user) > 0)
		{

			if($this->request->uri->getSegments()[1] == 'affiliate' && $user[0]->status_request == 'pending'){

				session()->setFlashdata('success', 'Sedang di tinjau Oleh Admin');
				return view('commerce/account', $data);

			} 

		}
		if($this->generate->find()[0]['nomor'] == 999){
			$this->generate->save(['id' => 1, 'nomor' => 1]);
		}

		

		return view('commerce/account', $data);
	}

	public function upgrade_stockist()
	{

		$data['segments'] = $this->request->uri->getSegments();

		if(in_groups(3))
		{			
			session()->setFlashdata('successs', 'Anda Adalah Stockist');
			return view('commerce/account', $data);
		}

		return view('commerce/account', $data);
	}

	public function upgrade()
	{
		$data = $this->data;

		helper(['status_upgrade_helper']);
		$upgrade         = new \App\Models\AccountUpgradeModel();
		$data['members'] = $upgrade->getAll();
		return view('db_admin/members/member_upgrade', $data);
	}

	public function action($value, $id)
	{
		$data = $this->data;

		$authorize = service('authorization');
		$upgrade   = new \App\Models\AccountUpgradeModel();
		$user      = $upgrade->getAll($id);

		
		switch ($value) {
			case 'rerject':
				$data = [
					'status' => 'rejected'
				];
				$update = $upgrade->update($id, $data);
				if ($update) {
					return redirect()->back();
				}
				break;
			
			default:
				$data = [
					'status' => 'approved'
				];
				$update = $upgrade->update($id, $data);
				if ($update) {
					$add_to_group = $authorize->addUserToGroup($user->id_user, 'stockist');
					// $remove_from_group = $authorize->removeUserFromGroup($user->id_user, 'user');
					return redirect()->back();
				}
				break;
		}
	}

	public function save_billing($id)
	{
		$data = $this->data;

		$data = [
			'user_id'       => $id,
			'provinsi'      => explode(",", $this->request->getPost('provinsi'))[1],
			'kabupaten'     => explode(",", $this->request->getPost('kabupaten'))[1],
			'kecamatan'     => explode(",", $this->request->getPost('kecamatan'))[1],
			'kode_pos'      => $this->request->getPost('kode_pos'),
			'detail_alamat' => $this->request->getPost('detail_alamat'),
			'type'          => 'billing',
		];

		$save = $this->address->save($data);
		if(!$save) {
			$data['addresses'] = $this->address->find($id);
			$data['errors']     = $this->address->errors();
	        return view('/address', $data); 
	    }
	    session()->setFlashdata('success', 'Data Berhasil Disimpan');
	    return redirect()->to(base_url('/address'));
	}

	public function save_shipping($id)
	{
		$data = $this->data;

		$data = [
			'user_id'       => $id,
			'provinsi'      => explode(",", $this->request->getPost('provinsi'))[1],
			'kabupaten'     => explode(",", $this->request->getPost('kabupaten'))[1],
			'kecamatan'     => explode(",", $this->request->getPost('kecamatan'))[1],
			'kode_pos'      => $this->request->getPost('kode_pos'),
			'detail_alamat' => $this->request->getPost('detail_alamat'),
			'type'          => 'shipping',
		];

		$save = $this->address->save($data);
		if(!$save) {
			$data['addresses'] = $this->address->find($id);
			$data['errors']     = $this->address->errors();
	        return view('/address', $data); 
	    }
	    session()->setFlashdata('success', 'Data Berhasil Disimpan');
	    return redirect()->to(base_url('/address'));
	}

	public function edit_billing($id)
	{
		$data = $this->data;

		$user_id = user()->id;

		$data = [
			'id'            => $id,
			'provinsi'      => explode(",", $this->request->getPost('provinsi'))[1],
			'kabupaten'     => explode(",", $this->request->getPost('kabupaten'))[1],
			'kecamatan'     => explode(",", $this->request->getPost('kecamatan'))[1],
			'kode_pos'      => $this->request->getPost('kode_pos'),
			'detail_alamat' => $this->request->getPost('detail_alamat'),
			'type'          => 'billing',
		];

		$save = $this->address->save($data);
		if(!$save) {
			$data['addresses'] = $this->address->find($user_id);
			$data['errors']     = $this->address->errors();
	        return view('/address', $data); 
	    }
	    session()->setFlashdata('success', 'Data Berhasil Diubah');
	    return redirect()->to(base_url('/address'));
	}

	public function edit_shipping($id)
	{
		$data = $this->data;

		$user_id = user()->id;

		$data = [
			'id'            => $id,
			'provinsi'      => explode(",", $this->request->getPost('provinsi'))[1],
			'kabupaten'     => explode(",", $this->request->getPost('kabupaten'))[1],
			'kecamatan'     => explode(",", $this->request->getPost('kecamatan'))[1],
			'kode_pos'      => $this->request->getPost('kode_pos'),
			'detail_alamat' => $this->request->getPost('detail_alamat'),
			'type'          => 'shipping',
		];

		$save = $this->address->save($data);
		if(!$save) {
			$data['addresses'] = $this->address->find($user_id);
			$data['errors']     = $this->address->errors();
	        return view('/address', $data); 
	    }
	    session()->setFlashdata('success', 'Data Berhasil Diubah');
	    return redirect()->to(base_url('/address'));
	}

	public function delete($id){

		$data = $this->data;

		$this->address->delete($id);
		return redirect()->back();
	}

}
