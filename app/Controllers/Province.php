<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;


class Province extends ResourceController
{

	protected $format    = 'json';

    public function index()
    {
    	$db      = \Config\Database::connect();
		$builder = $db->table('province');

		

		 return $this->respond($builder->get()->getResult());
		// $curl = curl_init();

		// curl_setopt_array($curl, array(
		//   CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
		//   CURLOPT_RETURNTRANSFER => true,
		//   CURLOPT_ENCODING => "",
		//   CURLOPT_MAXREDIRS => 10,
		//   CURLOPT_TIMEOUT => 30,
		//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//   CURLOPT_CUSTOMREQUEST => "GET",
		//   CURLOPT_HTTPHEADER => array(
		//     "key: bfacde03a85f108ca1e684ec9c74c3a9"
		//   ),
		// ));

		// $response = curl_exec($curl);
		// $err = curl_error($curl);

		// curl_close($curl);

		// return $response;
		
    }
}