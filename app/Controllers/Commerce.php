<?php

namespace App\Controllers;
use App\Models\OfferModel;

class Commerce extends BaseController
{
	public function index()
	{
		$model = new OfferModel();
		$data['offers'] = $model->findAll();

		return view('commerce/home', $data);
	}

	public function about()
	{
		
	}


	public function Cart()
	{
		return view('commerce/cart');
	}

	public function Account()
	{	
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
		// $email->setTo('imronpuji5@gmail.com');
		// $email->setTo('pujiselamat6@gmail.com');
		$email->setTo('m.hilmimubarok@gmail.com');

		$email->setSubject('Detail of ur track');
		$msg = view('track/index', $data);
		$email->setMessage($msg);

		if ($email->send()) {
			echo "sukses";
		}
		else 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }

		// return view('track/index', $data);
		// return view('track/index');
	}

	public function Contact()
	{
		return view('commerce/contact');
	}

	public function Checkout()
	{
		return view('commerce/checkout');
	}

	public function Product_detail()
	{
		return view('commerce/product_detail');
	}


	public function Courier()
	{
		$url="https://api.binderbyte.com/v1/list_courier?api_key=1c276a5a2b00d61eafaa0a22a92dd95329d409678a46d1b8e580cc7c80d71c97";
 
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		$response = curl_exec($curl);
		curl_close($curl);
		echo $response; 
	}

}
