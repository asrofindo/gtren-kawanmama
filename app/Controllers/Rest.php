<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;


class Rest extends ResourceController
{

    public function create()
    {

    	$r = $this->request;
    	
    	$origin = $r->getPost('origin'); 
    	$courier = $r->getPost('courier'); 
    	$destination = $r->getPost('destination'); 

   		for($i = 0; $i < 4; $i++){

   			$curl = curl_init();
			curl_setopt_array($curl, array(
			  	CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
			  	CURLOPT_RETURNTRANSFER => true,
			  	CURLOPT_ENCODING => "",
			 	CURLOPT_MAXREDIRS => 10,
			  	CURLOPT_TIMEOUT => 100,
			  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  	CURLOPT_CUSTOMREQUEST => "POST",
			  	CURLOPT_POSTFIELDS => "origin={$origin}&originType=city&destination={$destination}&destinationType=subdistrict&weight=1700&courier={$courier}",
			  	CURLOPT_HTTPHEADER => array(
			    	"content-type: application/x-www-form-urlencoded",
			    	"key: bfacde03a85f108ca1e684ec9c74c3a9"
			  	),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			return $response;
		
   		}
		
    }
}