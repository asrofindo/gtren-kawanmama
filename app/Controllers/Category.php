<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{

	protected $model;

	public function __construct()
	{
		$this->model = new CategoryModel();
	}

	public function index()
	{
		$data['categories'] = $this->model->findAll();
		return view('db_admin/produk/kategori', $data);
	}

	public function search()
	{
		$keyword            = $this->request->getPost('keyword');
		$data['categories'] = $this->model->like(['category' => $keyword])->findAll();
		return view('db_admin/produk/kategori', $data);;
	}

	public function save()
	{
		$data = [
			'category' => $this->request->getPost('category'),
			'description' => $this->request->getPost('description')
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

	public function edit($id)
	{
		$data['category'] = $this->model->getWhere([
			'id' => $id
		])->getRow();
		return view('db_admin/produk/kategori', $data);
	}

	public function update($id)
	{
		$data = [
			'category' => $this->request->getPost('category'),
			'description' => $this->request->getPost('description')
		];

		$update = $this->model->update($id, $data);

		// Notif
		if($update) {
	        session()->setFlashdata('success', 'Data Berhasil Diupdate');
	        return redirect()->to(base_url('admin/category'));
	    } else {
	        session()->setFlashdata('danger', 'Data Gagal Diupdate');
	        return redirect()->to(base_url('admin/category')); 
	    }

	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);

		// Notif
		if($delete) {
	        session()->setFlashdata('success', 'Data Berhasil Dihapus');
	        return redirect()->to(base_url('admin/category'));
	    } else {
	        session()->setFlashdata('danger', 'Data Gagal Dihapus');
	        return redirect()->to(base_url('admin/category')); 
	    }
	}
}
