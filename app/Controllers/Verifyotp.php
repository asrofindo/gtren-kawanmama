<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\OtpType;

class Verifyotp extends ResourceController
{

	protected $format    = 'json';

	public function __construct()
	{
		helper('wawoo')	;
		helper('auth');
	}

    public function create($value='')
    {
    	$db      = \Config\Database::connect();
		$builder = $db->table('users');

		$wa = $this->request->getPost('wa');
		$user_id = $this->request->getPost('user_id');
		$valOne = $this->request->getPost('valOne');
		$valTwo = $this->request->getPost('valTwo');
		$valTree = $this->request->getPost('valTree');
		$valFour = $this->request->getPost('valFour');
		$valFive = $this->request->getPost('valFive');

		$otp = [$valOne, $valTwo, $valTree, $valFour, $valFive];
		$otp = implode('', $otp);

    	$OTP = new OtpType();

		$initializeOtp = $OTP->initializeOtp('data', 'validate');
		$validateOtp = $initializeOtp->validate();
		if($validateOtp['user']->where('user_id', user()->id)->find() != null){

			if($validateOtp['user']->where('expired <', date("Y-m-d H:i:s"))->where('user_id', user()->id)->find() ){
				session()->setFlashdata('danger-otp', 'Gagal ! Cek Kembali OTP Anda');
				return redirect()->back();
			}
			if($validateOtp['user']->where('user_id', user()->id)->first()->otp != $otp){
				session()->setFlashdata('danger-otp', 'Gagal ! Cek Kembali OTP Anda');
				return redirect()->back();
			}
		} else {
			session()->setFlashdata('danger-otp', 'Gagal ! Cek Kembali OTP Anda');
			return redirect()->back();
		}

		$builder->where('id', user()->id)->update(["status_message" => 'verified']);
		wawoo(user()->phone, "Selamat ! Anda Sudah Terverifikasi Di ".'\n'.base_url());
		return redirect()->back();
    }

     public function show($value='')
    {
    	$db      = \Config\Database::connect();
		$builder = $db->table('users');

		$builder->where('id', $value)->update(["phone" => null, "status_message" => null]);
		return redirect()->to('/profile');
    }
}