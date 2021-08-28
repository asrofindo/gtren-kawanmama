<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Template extends BaseController
{
	public function category_menu(){

		$data['categories'] = $this->category->findAll();
		
		return view('commerce/template/header', $data);
	}
}
