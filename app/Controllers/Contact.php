<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;

class Contact extends BaseController
{

	public function __construct()
	{
		$this->model = new ContactModel();
	}

	public function index()
	{
		$data['contacts'] = $this->model->paginate(2, 'contacts');
		$data['pager'] = $this->model->pager;
		return view('db_admin/contact/contact', $data);
	}

	public function save()
	{
		$request = $this->request;
	
		$data = [
			'phone' => $request->getPost('phone'),
			'address' => $request->getPost('address'),
		];

		if(!$this->model->save($data)){
			$data['contacts'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/contact/contact', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Disimpan');
		return redirect()->to(base_url('/contact'));
	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);
		if(!$delete){
			$delete['contacts'] = $this->model->findAll();
			$delete['errors']     = $this->model->errors();
	        return view('db_admin/contact/contact', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Dihapus');

		return redirect()->to(base_url('/contact'));

	}

	public function edit($id)
	{
		$data['contact'] = $this->model->find($id);
		
		return view('db_admin/contact/edit_contact', $data);

	}

	public function update($id)
	{

		$request = $this->request;


	
		$data = [
			'id' => $id,
			'phone' => $request->getPost('phone'),
			'address' => $request->getPost('address'),
		];

		if(!$this->model->replace($data)){
			$data['contacts'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/contact/contact', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->to(base_url('/contact'));

	}

	public function search()
	{
		$keyword            = $this->request->getPost('keyword');
		$data['contacts'] = $this->model->like(['phone' => $keyword])->paginate(2, 'contacts');
		$data['pager'] = $this->model->pager;

		return view('db_admin/contact/contact', $data);;
	}
}
