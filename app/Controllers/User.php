<?php

namespace App\Controllers;
use App\Models\AccountUpgradeModel;
use App\Models\AddressModel;
use App\Models\UpgradesModel;

class User extends BaseController
{
	public function __construct(){
		$this->address = new AddressModel();
		$this->upgrade = new UpgradesModel();
	}
	public function account()
	{

		helper(['greeting_helper', 'user']);


		$data['segments'] = $this->request->uri->getSegments();

		return view('commerce/account', $data);
	}

	public function orders()
	{
		$data['segments'] = $this->request->uri->getSegments();

		return view('commerce/account', $data);
	}

	public function tracking()
	{
		$data['segments'] = $this->request->uri->getSegments();

		$curl = curl_init();

		$url = "https://api.binderbyte.com/v1/list_courier?api_key=1c276a5a2b00d61eafaa0a22a92dd95329d409678a46d1b8e580cc7c80d71c97";
		
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$response        = curl_exec($curl);
		$set_to_array    = json_decode($response, TRUE);
		$data['couries'] = $set_to_array;
		return view('commerce/account', $data);
	}

	public function track()
	{
		$curl    = curl_init();
		$awb     = $this->request->getPost('awb');
		$courier = $this->request->getPost('courier');

		$url     = "https://api.binderbyte.com/v1/track?api_key=1c276a5a2b00d61eafaa0a22a92dd95329d409678a46d1b8e580cc7c80d71c97&courier={$courier}&awb={$awb}";

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$response      = curl_exec($curl);
		$set_to_array  = json_decode($response, TRUE);
		$data['track'] = $set_to_array;


		$email = \Config\Services::email();

		// $email->setHeader('MIME-Version', '1.0; charset=utf-8');
		// $email->setHeader('Content-type', 'text/html');

		$email->setFrom('team@gtren.co.id', 'Gtren Team');
		$email->setTo('imronpuji5@gmail.com');
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

		
		$data['segments'] = $this->request->uri->getSegments();

		if($data['segments'][0] == 'billing-address' || $data['segments'] == 'shipping-address') {
			if(count($this->address->where('type', 'billing')->where('deleted_at', null)->get()->getResultArray()) > 0){
				return redirect()->to('/address');
			}
			if(count($this->address->where('type', 'shipping')->where('deleted_at', null)->get()->getResultArray()) > 0){
				return redirect()->to('/address');
			}

		}
		$data['billing_address'] = $this->address->where('type', 'billing')->where('deleted_at', null)->where('user_id', user()->id)->get()->getResult();
		$data['shipping_address'] = $this->address->where('type', 'shipping')->where('deleted_at', null)->where('user_id', user()->id)->get()->getResult();

		// verif
		return view('commerce/account', $data);
	}

	public function profile()
	{
		$data['segments'] = $this->request->uri->getSegments();

		return view('commerce/account', $data);
	}

	public function set_profile()
	{
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
		$data['segments'] = $this->request->uri->getSegments();

		if ($this->request->getPost()) {

			$upgrade = new AccountUpgradeModel();
			$data = [
				'user_id' => intval(user()->id),
				'code'    => $this->request->getPost('code'),
				'status'  => 'pending'
			];
			
			$save = $upgrade->insert($data);

			if (!$save) {
				return redirect()->back();
			}
			session()->setFlashdata('success', 'Sukses!, Silahkan menunggu proses verifikasi oleh Admin.');
			return redirect()->back();
		}

		$user = $this->upgrade->where('user_id', user()->id)->findAll();

		if($user[0]->status_request == 'pending' && $this->request->uri->getSegments()[1] == 'affiliate'){

			session()->setFlashdata('success', 'Sedang di tinjau Oleh Admin');
			return view('commerce/account', $data);

		}


		return view('commerce/account', $data);
	}

	public function upgrade_stockist()
	{
		$data['segments'] = $this->request->uri->getSegments();

		if ($this->request->getPost()) {

			$upgrade = new AccountUpgradeModel();
			$data = [
				'user_id' => intval(user()->id),
				'code'    => $this->request->getPost('code'),
				'status'  => 'pending'
			];
			
			$save = $upgrade->insert($data);

			if (!$save) {
				return redirect()->back();
			}
		}

	
		return view('commerce/account', $data);
	}

	public function upgrade()
	{
		helper(['status_upgrade_helper']);
		$upgrade         = new \App\Models\AccountUpgradeModel();
		$data['members'] = $upgrade->getAll();
		return view('db_admin/members/member_upgrade', $data);
	}

	public function action($value, $id)
	{
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

		$this->address->delete($id);
		return redirect()->back();
	}

}
