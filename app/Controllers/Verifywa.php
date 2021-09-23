<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\OtpType;

class Verifywa extends ResourceController
{

	protected $format    = 'json';

	public function __construct()
	{
		helper('wawoo')	;
		helper('auth');
	}

    public function create($val = '')
    {
    	$db      = \Config\Database::connect();
		$builder = $db->table('users');

		$wa = $this->request->getPost('wa');
		$user_id = $this->request->getPost('user_id');
	
		$builder->where('id', $user_id)->update(["phone" => $wa]);

		$OTP = new OtpType();

		$initializeOtp = $OTP->initializeOtp('data', 'validate');
		$validateOtp = $initializeOtp->validate();

		if($validateOtp['user']->find() != null){

			if($validateOtp['user']->where('expired <', date("Y-m-d H:i:s"))->where('user_id', user()->id)->find()){
				$initializeOtp = $OTP->initializeOtp($validateOtp['user']->where('user_id', user()->id)->first()->id, 'delete');
				$deleteOtp = $initializeOtp->delete();

				$initializeOtp = $OTP->initializeOtp('data', 'request');
				$requestOtp = $initializeOtp->request();	

				$sendOtp = $OTP->initializeOtp($requestOtp, 'send');
				$sendOtp->send();

				session()->setFlashdata('success-otp', 'OTP Sudah Dikirim');
				return redirect()->back();
				
			} else {
				$sendOtp = $OTP->initializeOtp($validateOtp['user']->otp, 'send');
				$sendOtp->send();

				session()->setFlashdata('success-otp', 'OTP Sudah Dikirim');
				return redirect()->back();
			}	

		} else {

			$initializeOtp = $OTP->initializeOtp('data', 'request');
			$requestOtp = $initializeOtp->request();	

			$sendOtp = $OTP->initializeOtp($requestOtp, 'send');
			$sendOtp->send();
		}
	
		return redirect()->back();
		
    }

    public function show($value='')
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

				session()->setFlashdata('success-otp', 'OTP Sudah Dikirim');
				return redirect()->back();
				
			} else {
				$sendOtp = $OTP->initializeOtp($validateOtp['user']->where('user_id', user()->id)->first()->otp, 'send');
				$sendOtp->send();

				session()->setFlashdata('success-otp', 'OTP Sudah Dikirim');
				return redirect()->back();
			}	

		} else {

			$initializeOtp = $OTP->initializeOtp('data', 'request');
			$requestOtp = $initializeOtp->request();	

			$sendOtp = $OTP->initializeOtp($requestOtp, 'send');
			$sendOtp->send();
		}
		return redirect()->back();
    }
}