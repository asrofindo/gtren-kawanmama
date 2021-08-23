<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OfferModel;

class Offer extends BaseController
{

	public function __construct()
	{
		$this->model = new OfferModel();
	}

	public function index()
	{
		$data['offers'] = $this->model->paginate(2, 'offers');
		$data['pager'] = $this->model->pager;
		return view('db_admin/offer/offer', $data);
	}

	public function save()
	{
		$request = $this->request;
		$file = $request->getFile('photo');

		$photo = [];

		$new_name = $file->getRandomName();

		$file->move(ROOTPATH . 'public/uploads/offer', $new_name);

		$data = [
			'title' => $request->getPost('title'),
			'description' => $request->getPost('description'),
			'photo' => $new_name,
		];

		if(!$this->model->save($data)){
			$data['offers'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/offer/offer', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Disimpan');
		return redirect()->to(base_url('/offer'));
	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);
		if(!$delete){
			$delete['offers'] = $this->model->findAll();
			$delete['errors']     = $this->model->errors();
	        return view('db_admin/offer/offer', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Dihapus');

		return redirect()->to(base_url('/offer'));

	}

	public function edit($id)
	{
		$data['offer'] = $this->model->find($id);
		
		return view('db_admin/offer/edit_offer', $data);

	}

	public function update($id)
	{

		$request = $this->request;


		$file = $request->getFile('photo');

		$photo = $this->model->find($id)->photo;

		$new_name = $photo;

		if($file->getName() != ''){

			$new_name = $file->getRandomName();

			$file->move(ROOTPATH . 'public/uploads/offer', $new_name);
		}

		$data = [
			'id' => $id,
			'title' => $request->getPost('title'),
			'description' => $request->getPost('description'),
			'photo' => $new_name,
		];

		if(!$this->model->replace($data)){
			$data['offers'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/offer/offer', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->to(base_url('/offer'));

	}

	public function search()
	{
		$keyword            = $this->request->getPost('keyword');
		$data['offers'] = $this->model->like(['title' => $keyword])->paginate(2, 'offers');
		$data['pager'] = $this->model->pager;

		return view('db_admin/offer/offer', $data);;
	}
}
