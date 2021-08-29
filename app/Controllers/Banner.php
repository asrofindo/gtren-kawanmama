<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class Banner extends BaseController
{

	public function __construct()
	{
		$this->model = new BannerModel();
	}

	public function index()
	{
		$data['title']='Benner | Gtren';

		$data['banners'] = $this->model->paginate(2, 'banners');
		$data['pager'] = $this->model->pager;

		return view('db_admin/banner/banner', $data);
	}

	public function save()
	{
		$request = $this->request;
		$file = $request->getFile('photo');

		$photo = [];

		$new_name = $file->getRandomName();

		$file->move(ROOTPATH . 'public/uploads/banner', $new_name);

		$data = [
			'title' => $request->getPost('title'),
			'sub_title' => $request->getPost('sub_title'),
			'description' => $request->getPost('description'),
			'offer' => $request->getPost('offer'),
			'photo' => $new_name,
		];

		if(!$this->model->save($data)){
			$data['banners'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/banner/banner', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Disimpan');
		return redirect()->to(base_url('/banner'));
	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);
		if(!$delete){
			$delete['banners'] = $this->model->findAll();
			$delete['errors']     = $this->model->errors();
	        return view('db_admin/banner/banner', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Dihapus');

		return redirect()->to(base_url('/banner'));

	}

	public function edit($id)
	{
		$data['banner'] = $this->model->find($id);
		
		return view('db_admin/banner/edit_banner', $data);

	}

	public function update($id)
	{

		$request = $this->request;


		$file = $request->getFile('photo');

		$photo = $this->model->find($id)->photo;

		$new_name = $photo;

		if($file->getName() != ''){

			$new_name = $file->getRandomName();

			$file->move(ROOTPATH . 'public/uploads/banner', $new_name);
		}

		$data = [
			'id' => $id,
			'title' => $request->getPost('title'),
			'sub_title' => $request->getPost('sub_title'),
			'description' => $request->getPost('description'),
			'offer' => $request->getPost('offer'),
			'photo' => $new_name,
		];

		if(!$this->model->replace($data)){
			$data['banners'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/banner/banner', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->to(base_url('/banner'));

	}
}
