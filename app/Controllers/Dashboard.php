<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		$data['segments'] = $this->request->uri->getSegments();
		return view('dashboard', $data);
	}

}
