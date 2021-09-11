<?php

namespace App\Controllers;
use App\Models\DetailTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\BillModel;
class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->model = new DetailTransaksiModel();
		$this->bill = new BillModel();
		$this->transaksi = new TransaksiModel();
	}
	public function index()
	{
		$data['segments'] = $this->request->uri->getSegments();

		$data['user'] = $this->model->select('sum(COALESCE(admin_commission,0))
          + COALESCE(stockist_commission,0)
          + COALESCE(affiliate_commission,0)
          AS user_total')
		->where('status_barang =', null)->orWhere('status_barang =', 'refund')->orWhere('status_barang =', 'Dikirim')->find();

		$data['admin'] = $this->model->select('sum(COALESCE(admin_commission,0)) AS admin_total')
		->where('status_barang =', 'diterima')->find();

		$data['stockist'] = $this->model->select('sum(COALESCE(stockist_commission,0)) AS stockist_total')
		->where('status_barang =', 'diterima')->find();

		$data['affiliate'] = $this->model->select('sum(COALESCE(affiliate_commission,0)) AS affiliate_total')
		->where('status_barang =', 'diterima')->find();
		$data['bills'] = $this->bill->findAll();
		$data['bills']   = $this->bill->paginate(4, 'bills');
		$data['pager']    = $this->bill->pager;
		return view('dashboard', $data);
	}

}
