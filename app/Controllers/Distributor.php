<?php

namespace App\Controllers;
use App\Models\AddressModel;

class Distributor extends BaseController
{
	public function __construct(){
		$this->address = new AddressModel();
	}
	public function index()
	{	
		$data['address'] = $this->address->where('user_id', user()->id)->find();
		return view('db_stokis/distributor', $data);
	}

	public function save()
	{

		$data = [
			'user_id'       => user()->id,
			'provinsi'      => explode(",", $this->request->getPost('provinsi'))[1],
			'kabupaten'     => explode(",", $this->request->getPost('kabupaten'))[1],
			'kecamatan'     => explode(",", $this->request->getPost('kecamatan'))[1],
			'kode_pos'      => $this->request->getPost('kode_pos'),
			'detail_alamat' => $this->request->getPost('detail_alamat'),
			'type'          => 'distributor',
		];

		$save = $this->address->save($data);
		if(!$save) {
			session()->setFlashdata('danger', 'Data Gagal Disimpan');
	        return redirect()->back(); 
	    }
	    session()->setFlashdata('success', 'Data Berhasil Disimpan');
	    return redirect()->back();
	}

	public function edit($id)
	{

		$data = [
			'id'			=> $id,
			'user_id'       => user()->id,
			'provinsi'      => explode(",", $this->request->getPost('provinsi'))[1],
			'kabupaten'     => explode(",", $this->request->getPost('kabupaten'))[1],
			'kecamatan'     => explode(",", $this->request->getPost('kecamatan'))[1],
			'kode_pos'      => $this->request->getPost('kode_pos'),
			'detail_alamat' => $this->request->getPost('detail_alamat'),
			'type'          => 'distributor',
		];

		$save = $this->address->save($data);
		if(!$save) {
			session()->setFlashdata('danger', 'Data Gagal Disimpan');
	        return redirect()->back(); 
	    }
	    session()->setFlashdata('success', 'Data Berhasil Disimpan');
	    return redirect()->back();
	}



}
