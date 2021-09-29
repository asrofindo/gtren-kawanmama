<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Notif extends ResourceController
{

	protected $format    = 'json';


     public function index($value='')
    {
    	$db      = \Config\Database::connect();
		$builder = $db->table('notif');

		return $this->respond($builder->get()->getResult());
    }
}