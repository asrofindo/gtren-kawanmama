<?php

namespace App\Controllers;
use App\Models\OfferModel;
use App\Models\CategoryModel;
use App\Models\CartItemModel;


class Commerce extends BaseController
{
	protected $data;

	public function __construct()
	{		
		$this->category = new CategoryModel();
		$this->data['category']    = $this->category->findAll();
		$this->cart = new CartItemModel();
		

	}

	public function index()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Lengkapi Data Nomer Telepon');
			return redirect()->to('/profile');
		}
		$model = new OfferModel();
		$data['offers'] = $model->findAll();
		return view('commerce/home', $data);
	}

	public function about()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Lengkapi Data Nomer Telepon');
			return redirect()->to('/profile');
		}
		$data=$this->data;
		$data['title']='About | Gtren';
		return view('commerce/about',$data);
	}


	public function Cart($id=null)
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Lengkapi Data Nomer Telepon');
			return redirect()->to('/profile');
		}
		$data['title']='Cart | Gtren';
		if (user() == null) {
			return redirect()->to('/login');
		}
		$data=$this->data;
		
		$data['title']='Cart | Gtren';
		$data['carts'] = $this->cart->select('*, cart_item.id as id, detailtransaksi.id as d_id')
	      ->join('products', "products.id = cart_item.product_id ", 'left')
	      ->join('detailtransaksi', "cart_item.id = detailtransaksi.cart_id ", 'left')
	      ->where('cart_item.user_id', user()->id)
	      ->where('cart_item.status', null)->findAll();
	    $data_cart = [];
	    
	    foreach ($data['carts'] as $cart ) {
	     	if($cart->d_id == null){

     		 	array_push($data_cart, $cart);
	     	} else {
	     		$data['carts'] = [];
	     	}
	     }
	    $data['carts'] = $data_cart;
		$sumTotal = 0;

		for($i = 0; count($data['carts']) > $i; $i++){
			$sumTotal += $data['carts'][$i]->total;
			}

		$data['total'] = $sumTotal;
		return view('commerce/cart',$data);
	}

	public function Account()
	{	
		$data = $this->data;
		
		$data['title']='Account | Gtren';

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
		$data = $this->data;
		$data['title']='Track | Gtren';

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
		$data=$this->data;
		$data['title']='Contact | Gtren';

		return view('commerce/contact',$data);
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
