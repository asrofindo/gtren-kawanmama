<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;

class Order extends BaseController
{
	public function __construct()
	{
		$this->model = new TransaksiModel();
	}
	public function update($id)
	{
		$status = $this->request->getPost("status");
		$this->model->save(["id" => $id, "status_pembayaran" => $status]);
		return redirect()->back();

	}
}