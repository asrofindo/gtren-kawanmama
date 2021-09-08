<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BillModel;

class Bill extends BaseController
{
	public function __construct()
	{
		$this->model = new BillModel();
	}
	public function index()
	{

		if ($this->request->getPost()) {

			$data       = $this->request->getPost();
			$bill       = new \App\Entities\Bill($data);
			$validation =  \Config\Services::validation();
			$validation->setRules(
				[
					'bank_name'   => 'required',
					'bank_number' => 'required|is_unique[bills.bank_number]|max_length[16]|min_length[16]',
					'owner'       => 'required'
				],
				[
	        	"bank_name" => [
	        		"required" => "Nama Bank Harus Diisi"
	        	],
	        	"bank_number" => [
					"required"   => "Nomor Rekening Harus Diisi",
					"is_unique"  => "Nomor Rekening Sudah Ada",
					"max_length" => "Nomor Rekening Tidak Boleh Lebih Dari 16",
					"min_length" => "Nomor Rekening Tidak Boleh Kurang Dari 16"
	        	],
	        	"owner" => [
	        		"required"  => "Nama Pemilik Rekening Harus Diisi"
	        	]
	        ]
			);

	        $isDataValid = $validation->withRequest($this->request)->run();


	        if ($isDataValid) {

				$save  = $this->model->save($bill);

				if (!$save){
					return redirect()->back()->withInput()->with('errors', $this->model->errors());
				} else{

					session()->setFlashdata('success', 'Data Berhasil Disimpan');
					return redirect()->to(base_url('bill'));
				}
	        } else {
				return redirect()->back()->withInput()->with('errors', $this->model->errors());
	        }
			
		}

		$data['bills'] = $this->model->findAll();

		return view('db_admin/bills/index', $data);


	}

	public function edit($id)
	{
		$data['bill'] = $this->model->getWhere([
			'id' => $id
		])->getRow();
		return view('db_admin/bills/index', $data);
	}

	public function update($id)
	{
		$data = [
			'bank_name'   => $this->request->getPost('bank_name'),
			'bank_number' => $this->request->getPost('bank_number'),
			'owner'       => $this->request->getPost('owner')
		];

		$validation =  \Config\Services::validation();
        $validation->setRules(
        	[
	        	"bank_name"   => "required",
				"bank_number" => "required|is_unique[bills.bank_number, id, $id]|max_length[16]|min_length[16]",
				"owner"       => "required"
	        ],
	        [
	        	"bank_name" => [
	        		"required" => "Nama Bank Harus Diisi"
	        	],
	        	"bank_number" => [
					"required"   => "Nomor Rekening Harus Diisi",
					"is_unique"  => "Nomor Rekening Sudah Ada",
					"max_length" => "Nomor Rekening Tidak Boleh Lebih Dari 16",
					"min_length" => "Nomor Rekening Tidak Boleh Kurang Dari 16"
	        	],
	        	"owner" => [
	        		"required"  => "Nama Pemilik Rekening Harus Diisi"
	        	]
	        ]
	    );
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {

			$update = $this->model->update($id, $data);

			if($update) {
		        session()->setFlashdata('success', 'Data Berhasil Diupdate');
		        return redirect()->back();
		    } else {
		        return redirect()->back()->withInput()->with('errors', $this->model->errors()); 
		    }
        } else {
	        return redirect()->back()->withInput()->with('errors', $this->model->errors()); 
        }


	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);

		if($delete) {
	        session()->setFlashdata('success', 'Data Berhasil Dihapus');
	        return redirect()->back();
	    } else {
	        session()->setFlashdata('danger', 'Data Gagal Dihapus');
	        return redirect()->back(); 
	    }
	}

	public function search()
	{

		$keyword      = $this->request->getPost('keyword');
		$data['bills'] = $this->model->like(['bank_name' => $keyword])->findAll();

		return view('db_admin/bills/index', $data);;
	}
}
