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
		if (user()!=null && user()->phone == null) {
			session()->setFlashdata('error', 'Perlu Melengkapi Nama Dan Nomor Whatsapp');
			return redirect()->to('/profile');
		}
		$data['title']='Contact | Gtren';

		$data['contacts'] = $this->model->paginate(2, 'contacts');
		$data['pager'] = $this->model->pager;
		return view('db_admin/contact/contact', $data);
	}

	public function save()
	{
		$request = $this->request;
	
		$data = [
			'name' => $request->getPost('name'),
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
		$data['title']='Contact | Gtren';

		return view('db_admin/contact/edit_contact', $data);

	}

	public function update($id)
	{

		$request = $this->request;


	
		$data = [
			'id' => $id,
			'name' => $request->getPost('name'),
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
		$data['title']='Contact | Gtren';
		$keyword            = $this->request->getPost('keyword');
		$data['contacts'] 	= $this->model->like(['name' => $keyword])->paginate(2, 'contacts');
		$data['pager'] 		= $this->model->pager;

		return view('db_admin/contact/contact', $data);;
	}
}
