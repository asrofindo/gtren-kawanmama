<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Testing extends BaseController
{
	public function index()
	{
		return view('test');
	}
	public function testfoto()
	{
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$imagefile = $this->request->getFileMultiple('photos');

		foreach ($imagefile as $img) {

			$new_name = $img->getRandomName();
			$data = [
				'photos' => $new_name
			];
			$img->move(WRITEPATH . "uploads", $new_name);

			// if ($img->isValid() && ! $img->hasMoved())
			// {
			    
			// }

		}

		dd($data);
		
	}
}
