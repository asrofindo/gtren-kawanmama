<?php

namespace App\Controllers;
use App\Models\Payments;
use Xendit\Xendit;

class Channels extends BaseController
{

	public function __construct()
	{
		$this->model = new Payments();
	}

	public function index()
	{
		Xendit::setApiKey(api()[0]->token);

		$data['payment_channels'] = [];
		if(api() != []) $data['payment_channels'] = \Xendit\PaymentChannels::list();

		$data['title']='Benner | Gtren';

		$data['channels'] = $this->model->paginate(15, 'channels');
		$data['pager'] = $this->model->pager;

		return view('db_admin/channel/channel', $data);
	}

	public function save()
	{
		Xendit::setApiKey(api()[0]->token);
		$request = $this->request;
		if($this->model->where('channel_code', $request->getPost('payment_channel'))->find() != []){
			session()->setFlashdata('danger', 'Channel Sudah Ada');
			return redirect()->to(base_url('/setting/channels/get'));
		}
		$x = \Xendit\PaymentChannels::list();

		foreach ($x as $key => $value) {
			if($value['channel_code'] == $request->getPost('payment_channel')){
				$data = [
					'channel_code' => $request->getPost('payment_channel'),
					'name' => $value['name']
				];

				if(!$this->model->save($data)){
					$data['errors']     = $this->model->errors();
			        return view('db_admin/channel/channel', $data); 
				} 
			}
		}

		$data['payment_channels'] = $this->model->findAll();

		session()->setFlashdata('success', 'Data Berhasil Disimpan');
		return redirect()->to('/setting/channels/get'); 

	}

	public function delete($id)
	{
		$delete = $this->model->delete($id);
		if(!$delete){
			$delete['channels'] = $this->model->findAll();
			$delete['errors']     = $this->model->errors();
	        return view('db_admin/channel/channel', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Dihapus');

		return redirect()->to(base_url('/setting/channels/get'));

	}

	public function edit($id)
	{
		$data['channel'] = $this->model->find($id);
		
		return view('db_admin/channel/edit_channel', $data);

	}

	public function update($id)
	{

		$request = $this->request;


		$file = $request->getFile('photo');

		$photo = $this->model->find($id)->photo;

		$new_name = $photo;

		if($file->getName() != ''){

			$new_name = $file->getRandomName();

			$file->move(ROOTPATH . 'public/uploads/channel', $new_name);
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
			$data['channels'] = $this->model->findAll();
			$data['errors']     = $this->model->errors();
	        return view('db_admin/channel/channel', $data); 
		} 

		session()->setFlashdata('success', 'Data Berhasil Diupdate');
		return redirect()->to(base_url('/channel'));

	}
}
