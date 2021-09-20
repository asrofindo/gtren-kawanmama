<?php

namespace App\Controllers;
use App\Models\AccountUpgradeModel;
use App\Models\AddressModel;
use App\Models\UpgradesModel;
use App\Models\GenerateModel;
use App\Models\BillModel;
use App\Models\TransaksiModel;
use App\Models\CategoryModel;
use App\Models\KonfirmasiModel;
use App\Models\NotifModel;
use App\Models\RekeningModel;
use App\Models\SosialModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Authorization\GroupModel;
use App\Controllers\OtpType;
class User extends BaseController
{
	protected $data;
	
	public function __construct(){
		$this->sosial = new SosialModel();
		$this->data['sosial']    = $this->sosial->findAll();
		$this->address = new AddressModel();
		$this->rekening = new RekeningModel();
		$this->upgrade = new UpgradesModel();
		$this->transaksi = new TransaksiModel();
		$this->konfirmasi = new KonfirmasiModel();
		$this->notif = new NotifModel();

		$this->category = new CategoryModel();
		$this->data['category']    = $this->category->findAll();
		$this->User = new UserModel();
		$this->group = new GroupModel();
		$this->generate = new GenerateModel();
		$this->bill = new BillModel();
		$this->address = new AddressModel();

	}
	public function account()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}

		helper(['greeting_helper', 'user']);

		$data = $this->data;
		$data['segments'] = $this->request->uri->getSegments();

		return view('commerce/account', $data);
	}

	
	public function orders()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;

		$data['segments'] = $this->request->uri->getSegments();

		$data['transaksis'] = $this->transaksi->select('*, bills.total as total_bill, transaksi.total as total, transaksi.id as id,  bills.id as bill_id')
		->join('bills', 'bills.id = transaksi.bill_id', 'left')->orderBy('transaksi.id',"DESC")
		->where('user_id', user()->id)->findAll();
		 
		return view('commerce/account', $data);
	}

	public function affiliate()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;
		
		return view('db_affiliate/market_affiliate', $data);
	}

	public function order_detail($transaksi_id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;

		$data['segments'] = $this->request->uri->getSegments();
		$id = user()->id;
		$data['details_order'] = $this->transaksi
		->select('*, detailtransaksi.id as id')
		->join('detailtransaksi', "detailtransaksi.transaksi_id = transaksi.id")
		->join('cart_item', "detailtransaksi.cart_id = cart_item.id AND cart_item.user_id = {$id}")
		->join('products', 'products.id = cart_item.product_id')
		->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id')
		->join('pengiriman', 'detailpengiriman.pengiriman_id = pengiriman.id')
		->where('transaksi.id', $transaksi_id)
		->find();

		return view('commerce/account', $data);
	}

	public function konfirmasi($id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;
		$bill_id = $this->request->getPost('bill_id');

		$data['segments'] = $this->request->uri->getSegments();
		
		$data['transaksi'] = $this->transaksi->where('id',$id)->first();
		
		$data['konfirmasi'] = $this->konfirmasi->where('transaksi_id',$id)->first();
		
		if($bill_id == null){
			$data['bill'] = $this->bill->where('id',$data['transaksi']->bill_id)->first();
		}

		if ($this->request->getPost('date')!=null) {
			$data = [
				'user_id' => user()->id,
				'transaksi_id' => $bill_id ? null : $id,
				'date' => $this->request->getPost('date'),
				'total' => $this->request->getPost('total'),
				'bill' => $this->request->getPost('bill') ? $this->request->getPost('bill') : $bill_id,
				'keterangan' => $this->request->getPost('keterangan'),
			];
			$data['konfirmasi'] = $this->konfirmasi->where('transaksi_id',$id)->first();

			if ($data['konfirmasi'] ==[]) {
				$this->konfirmasi->save($data);
			}else{
				$this->konfirmasi->update($data['konfirmasi']->id,$data);
			}
			session()->setFlashdata('success', 'Terimakasih, Konfirmasi anda sudah kami catat. Akan dicek oleh staff kami.');

			$msg = base_url()."\n".user()->greeting." ".user()->fullname."\nTerimakasih, konfirmasi pembayaranan dari Anda sudah kami catat. Team Admin akan segera memverifikasi. Mohon ditunggu.\n";
			wawoo(user()->phone,$msg);

			$msg="Pembeli ini mengisi *KONFIRMASI PEMBAYARAN*\nSegera cek rekening!\nKunjungi: ".base_url('/admin/konfirmasi');			
			$notif = $this->notif->findAll();
			foreach ($notif as $key => $value) {
				wawoo($value['phone'],$msg);
			}

			return redirect()->back();
		}
		return view('commerce/account', $data);
	}

	public function tracking()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;


	
		$data['segments'] = $this->request->uri->getSegments();

		
		$data['billing_address'] = $this->address->where('type', 'billing')->where('deleted_at', null)->where('user_id', user()->id)->get()->getResult();
		$data['shipping_address'] = $this->address->where('type', 'shipping')->where('deleted_at', null)->where('user_id', user()->id)->get()->getResult();
		
		if ($data['billing_address']==[]) {
			session()->setFlashdata('warning', 'Anda harus menambahkan alamat!');
		}
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
			'id' => user()->id,
			'fullname' => $request->getPost('fullname'),
			'email' => $request->getPost('email'),
			'password' => $request->getPost('password'),
			'phone' => $request->getPost('phone'),
			'greeting' => $request->getPost('greeting'),
			'status_message' => $request->getPost('phone') == user()->phone ? 'verified' : null,
		];

		session()->setFlashdata('success', 'Silahkan  Minta Kode OTP Anda');

		if (user()->phone==null) {
			user()->setProfile($data);

			$msg="Selamat!\nAda *user baru* di ".base_url()."\nNama User :".user()->greeting." ".user()->fullname."\nNo. Wa: ".$data['phone'];			
			$notif = $this->notif->findAll();

			foreach ($notif as $key => $value) {
				wawoo($value['phone'],$msg);
			}
		}else{
			user()->setProfile($data);
		}
		session()->setFlashdata('success', 'Data sudah berhasil dimasukan');
		$address = $this->address->where('user_id',user()->id)->where('type','billing')->first();
		if ($address == null) {

			session()->setFlashdata('warning', 'Anda harus menambahkan alamat!');
			return redirect()->to('/address');
		}
		
		return redirect()->back();

	}

	public function upgrade_affiliate()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;

		$data['segments'] = $this->request->uri->getSegments();
		$data['bills'] = $this->bill->findAll();
		$data['generate'] = $this->generate->find()[0]['nomor'];
		$data['upgrades'] = $this->upgrade->where('user_id', user()->id)->findAll();
		$data['konfirmasi'] = $this->konfirmasi->where('user_id', user()->id)->where('transaksi_id', null)->first();

		$user = $this->upgrade->where('user_id', user()->id)->find();

		
		if(in_groups(4))
		{
			session()->setFlashdata('success', 'Anda Adalah affiliate');
			return view('commerce/account', $data);
		}
		
		if(count($user) > 0)
		{
			
			if($this->request->uri->getSegments()[1] == 'affiliate' && $user[0]->status_request == 'pending'){
				$data['data'] = $this->upgrade->where('user_id', user()->id)->first();
				$data['bill'] = $this->bill->where('id',$data['data']->bill)->first();

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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;


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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;

		helper(['status_upgrade_helper']);
		$upgrade         = new \App\Models\AccountUpgradeModel();
		$data['members'] = $upgrade->getAll();
		return view('db_admin/members/member_upgrade', $data);
	}

	public function action($value, $id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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

		if ($this->rekening->where('user_id',user()->id)->find()==[]) {
			session()->setFlashdata('danger', 'Masukan Data Rekening Anda');
			return redirect()->to('/rekening');
		}

	    return redirect()->to(base_url('/address'));
	}

	public function save_shipping($id)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
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

	public function admin($id){
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$segment = $this->request->uri->getSegments();

		if($segment[0] == 'make'){
			$this->group->addUserToGroup(user()->id, $id);
			return 'berhasil Buat Admin';

		} 

		$this->group->removeUserFromGroup(user()->id, $id);

		return 'berhasil';
	}

	public function rekening()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data = $this->data;

		if ($this->request->getPost('number')!=null) {
			$set=[
				'user_id'=> user()->id,
				'bank'=> $this->request->getPost('bank'),
				'number'=> $this->request->getPost('number'),
				'owner'=> $this->request->getPost('owner'),
			];
			$this->rekening->save($set);
			session()->setFlashdata('success', 'data berhasil disimpan');

		}

		$data['segments'] = $this->request->uri->getSegments();
		$data['rekening'] = $this->rekening->where('user_id',user()->id)->find();
		
		return view('commerce/account', $data);
	}

	public function rekening_delete($id)
	{
		$data = $this->data;

		$this->rekening->delete($id);
		session()->setFlashdata('success', 'data berhasil dihapus');

		return redirect()->back();
	}


	public function request_otp($value='')
	{
		$OTP = new OtpType();

		$initializeOtp = $OTP->initializeOtp('data', 'validate');
		$validateOtp = $initializeOtp->validate();
		if($validateOtp['user']->find() != null){

			if($validateOtp['user']->where('expired <', date("Y-m-d H:i:s"))->where('user_id', user()->id)->find() ){

				$initializeOtp = $OTP->initializeOtp($validateOtp['user']->where('user_id', user()->id)->first()->id, 'delete');
				$deleteOtp = $initializeOtp->delete();

				$initializeOtp = $OTP->initializeOtp('data', 'request');
				$requestOtp = $initializeOtp->request();	

				$sendOtp = $OTP->initializeOtp($requestOtp, 'send');
				$sendOtp->send();
				session()->setFlashdata('success', 'OTP Sudah Dikirim');
				return redirect()->back();
				
			} else {

				$sendOtp = $OTP->initializeOtp($validateOtp['user']->first()->otp, 'send');
				$sendOtp->send();
				session()->setFlashdata('success', 'OTP Sudah Dikirim');
				return redirect()->back();
			}	

		} else {

				$initializeOtp = $OTP->initializeOtp('data', 'request');
				$requestOtp = $initializeOtp->request();	

				$sendOtp = $OTP->initializeOtp($requestOtp, 'send');
				$sendOtp->send();
				session()->setFlashdata('success', 'OTP Sudah Dikirim');
				return redirect()->back();
		}

	}
	

}
