<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Profiles;

class Factory extends BaseController
{

	public function __construct()
	{
		$this->model = new Profiles();
	}

	public function index()
	{
		$data['title']='Benner | Gtren';

		$data['profiles'] = $this->model->paginate(2, 'profiles');
		$data['pager'] = $this->model->pager;

		return view('db_admin/profile/profile', $data);
	}

	public function save()
	{
		$request = $this->request;
		$file = $request->getFile('photo');

		$photo = [];

		$new_name = $file->getRandomName();

		$file->move(ROOTPATH . 'public/uploads/banner', $new_name);


		$fav = $request->getFile('favicon');

		$photo = [];

		$favName = $fav->getRandomName();

		$fav->move(ROOTPATH . 'public/uploads/banner', $favName);

		$data = [
			'title' => $request->getPost('title'),
			'favicon' => $favName,
			'photo' => $new_name,
		];

		if(!$this->model->save($data)){
			$data['profiles'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/profile/profile', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Disimpan');
		return redirect()->to(base_url('/factory'));
	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);
		if(!$delete){
			$delete['profiles'] = $this->model->findAll();
			$delete['errors']     = $this->model->errors();
	        return view('db_admin/profile/profile', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Dihapus');

		return redirect()->to(base_url('/factory'));

	}

	public function edit($id)
	{
		$data['profile'] = $this->model->find($id);
		
		return view('db_admin/profile/edit_profile', $data);

	}

	public function update($id)
	{

		$request = $this->request;


		$file = $request->getFile('photo');

		$photo = $this->model->find($id)->photo;

		$new_name = $photo;

		$fav = $request->getFile('favicon');

		$favName = $this->model->find($id)->favicon;

		$favNewName = $favName;
		

		if($file->getName() != ''){

			$new_name = $file->getRandomName();

			$file->move(ROOTPATH . 'public/uploads/banner', $new_name);
		}

		if($fav->getName() != ''){

			$favNewName = $fav->getRandomName();

			$fav->move(ROOTPATH . 'public/uploads/banner', $favNewName);
		}

		$data = [
			'id' => $id,
			'title' => $request->getPost('title'),
			'photo' => $new_name,
			'favicon' => $favNewName,
		];

		if(!$this->model->replace($data)){
			$data['profiles'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/profile/profile', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->to(base_url('/factory'));

	}
}
