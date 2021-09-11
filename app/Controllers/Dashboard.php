<?php

namespace App\Controllers;
use App\Models\DetailTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\BillModel;
use App\Models\UpgradesModel;
class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->model = new DetailTransaksiModel();
		$this->bill = new BillModel();
		$this->transaksi = new TransaksiModel();
		$this->upgrades = new UpgradesModel();
	}
	public function index()
	{
		$data['segments'] = $this->request->uri->getSegments();

		$data['user'] = $this->model->select('sum(COALESCE(admin_commission,0))
          + COALESCE(stockist_commission,0)
          + COALESCE(affiliate_commission,0)
          AS user_total')
		->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id', 'left')
		->where('transaksi.status_pembayaran', 'paid')
		->where('status_barang =', null)->orWhere('status_barang =', 'refund')->orWhere('status_barang =', 'Dikirim')->find();
		$data['upgrades'] = $this->upgrades->select('sum(total) as total_upgrades')->where('status_request', 'active')->findAll();
		
		$data['admin'] = $this->model->select('sum(COALESCE(admin_commission,0)) AS admin_total')
		->where('status_barang =', 'diterima')->find();

		$data['admin'] = [["admin_total" => $data['admin'][0]['admin_total'] + $data['upgrades'][0]->total_upgrades ]];

		$data['stockist'] = $this->model->select('sum(COALESCE(stockist_commission,0) - COALESCE(pendapatan.keluar,0)) AS stockist_total')
		->join('distributor', 'distributor.id = detailtransaksi.distributor_id ', 'left')
		->join('pendapatan', 'pendapatan.user_id = distributor.user_id ', 'left')
		->where('status_barang =', 'diterima')
		->where('pendapatan.status_dana =', 'distributor')
		->find();

		$data['affiliate'] = $this->model->select('sum(COALESCE(affiliate_commission,0) - COALESCE(pendapatan.keluar,0)) AS affiliate_total')
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id ', 'left')
		->join('users', 'users.affiliate_link = cart_item.affiliate_link', 'left')
		->join('pendapatan', 'pendapatan.user_id = users.id', 'left')
		->where('status_barang =', 'diterima')
		->where('pendapatan.status_dana =', 'affiliate')
		->find();

		$data['bills'] = $this->bill->findAll();
		$data['bills']   = $this->bill->paginate(4, 'bills');
		$data['pager']    = $this->bill->pager;
		return view('dashboard', $data);
	}

}
