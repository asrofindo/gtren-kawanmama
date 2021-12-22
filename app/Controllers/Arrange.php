<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Arrange extends ResourceController
{

	protected $format    = 'json';

    public function create()
    {
    	// data post
    		$id = '';
    		$data = json_decode(file_get_contents('php://input'),true);
    	// end

    	// database
	    	$db      = \Config\Database::connect();
			$builder = $db->table('payments');
		// end


		// operation
			foreach ($data as $key => $value) {
				$builder->where("id", $value["id"])->update(["page" => $key + 1]);
			}
			 return $this->respond('Selesai');
		// end

    }

}
