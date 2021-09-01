<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\ProductModel;

class Comment extends BaseController
{

	protected $model;
	protected $product;

	public function __construct()
	{
		$this->model = new CommentModel();
		$this->product = new ProductModel();
	}

	public function index()
	{
		//
	}

	public function getByProduct()
	{
		// $product = $this->model->where('slug', $slug)->first(); 
		// //
		// $commit = $this->model->where('slug', $slug)->first(); 


	}

	public function save()
	{
		$data = [
			'user_id' => $this->request->getPost('user_id'),
			'product_id' => $this->request->getPost('product_id'),
			'rating' => $this->request->getPost('description')
		];

		$save = $this->model->insert($data);

		// Notif
		if($save) {
	        session()->setFlashdata('success', 'Data Berhasil Disimpan');
	        return redirect()->to(base_url('category'));
	    } else {
	        session()->setFlashdata('danger', 'Data Gagal Disimpan');
	        return redirect()->to(base_url('category')); 
	    }

	}

	public function delete()
	{
		
	}
}
