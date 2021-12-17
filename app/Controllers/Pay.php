<?php

namespace App\Controllers;
use App\Controllers\Order;
use CodeIgniter\RESTful\ResourceController;

class Pay extends ResourceController
{

	protected $format    = 'json';

	public function __construct()
	{
		helper('wawoo')	;
	}

    public function create()
    {
		// class
			$order = new Order();		
		// end

    	// data post
    		$id = '';
    		$data = json_decode(file_get_contents('php://input'),true); 
    		if(isset($data['id'])) $id = $data['external_id'];
    		if(!isset($data['id'])) $id = $data['data']['external_id'];
    	// end

    	// database
	    	$db      = \Config\Database::connect();
			$builder = $db->table('transaksi');
			$result = $builder->select('*')->where('id', $id)->get()->getResult();
		// end


		// operation
			if($result == []) return $this->respond('Data Tidak Ditemukan');
			if($order->update($result[0]->id)) return $this->respond('Pembayaran Berhasil Dilakukan');
		// end

    }
}