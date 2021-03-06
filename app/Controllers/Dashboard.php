<?php

namespace App\Controllers;
use App\Models\DetailTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\BillModel;
use App\Models\AddressModel;
use App\Models\RiwayatBill;
use App\Models\PendapatanModel;
use App\Models\UpgradesModel;
class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->model = new DetailTransaksiModel();
		$this->bill = new BillModel();
		$this->transaksi = new TransaksiModel();
		$this->upgrades = new UpgradesModel();
		$this->pendapatan = new PendapatanModel();
		$this->address = new AddressModel();
		$this->riwayat = new RiwayatBill();

	}
	public function index()
	{

		// mendapatakan data rekening

		if(count($this->bill->find()) < 1 && in_groups(1)){
			$data['bills'] = [];
			session()->setFlashdata('danger', 'Akun Bank Wajib Diisi Terlebih Dahulu');
			return redirect()->to('/bills');
		}
		if(count($this->address->where('type','distributor')->where('user_id',user()->id)->find()) < 1 && in_groups(3)){
			session()->setFlashdata('danger', 'Anda harus menyelesaikan SETTING DISTRIBUTOR!');
			return redirect()->to('/distributor');
		}

		$data['segments'] = $this->request->uri->getSegments();

		$data['user'] = $this->model->select('sum(COALESCE(admin_commission,0)) + sum(COALESCE(stockist_commission,0)) + sum(COALESCE(affiliate_commission,0)) as user_total')
          ->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id AND transaksi.status_pembayaran = "paid"')
 
          ->orWhere('status_barang =', null)->orWhere('status_barang !=', 'diterima_pembeli')
 			->orWhere('status_barang =', 'refund')->orWhere('status_barang =', 'dikirim')
          ->findAll();

		$data['upgrades'] = $this->upgrades->select('sum(total) as total_upgrades')->where('status_request', 'active')->findAll();
		
		$data['admin'] = $this->model->select('sum(COALESCE(admin_commission,0)) AS admin_total')
		->where('status_barang =', 'diterima_pembeli')->find();

		$data['kode_unik'] = $this->transaksi->select('sum(COALESCE(kode_unik,0)) AS kode_unik_admin')->where('status_pembayaran', 'paid')->find();
		$kode_unik  = 0;
		$data['riwayat_bill_tarik'] = $this->riwayat->where('type', 'tarik')->select('sum(COALESCE(money,0)) as tarik')->findAll();
		$data['riwayat_bill_setor'] = $this->riwayat->where('type', 'setoran')->select('sum(COALESCE(money,0)) as setor')->findAll();
		$data['riwayat_total'] = $data['riwayat_bill_setor'][0]['setor'] - $data['riwayat_bill_tarik'][0]['tarik'];

		$data['admin'] = [["admin_total" => $data['admin'][0]->admin_total + $data['upgrades'][0]->total_upgrades + $kode_unik + $data['riwayat_total']]];

		$data['pendapatan'] = $this->pendapatan->select('sum(COALESCE(total,0)) as total')->where('status_dana', 'user')->findAll();

		$data['stockist'] = $this->model->select('sum(COALESCE(stockist_commission,0)) - COALESCE(pendapatan.keluar,0) AS stockist_total')
		->join('distributor', 'distributor.id = detailtransaksi.distributor_id ', 'left')
		->join('pendapatan', 'pendapatan.user_id = distributor.user_id ', 'left')
		->where('status_barang =', 'diterima_pembeli')
		->where('pendapatan.status_dana =', 'distributor')
		->find();

		// jika user role nya adalah stockist

		$data['affiliate'] = $this->model->select('sum(COALESCE(affiliate_commission,0)) - COALESCE(pendapatan.keluar,0) AS affiliate_total')
		->join('cart_item', 'cart_item.id = detailtransaksi.cart_id ', 'left')
		->join('users', 'users.affiliate_link = cart_item.affiliate_link', 'left')
		->join('pendapatan', 'pendapatan.user_id = users.id', 'left')
		->where('status_barang =', 'diterima_pembeli')
		->where('pendapatan.status_dana =', 'affiliate')
		->find();
		
		if(in_groups(3)){

			$data['stockist'] = $this->model->select('sum(COALESCE(stockist_commission,0)) - COALESCE(pendapatan.keluar,0) AS stockist_total')
			->join('distributor', 'distributor.id = detailtransaksi.distributor_id ', 'left')
			->join('pendapatan', 'pendapatan.user_id = distributor.user_id ', 'left')
			->where('status_barang =', 'diterima_pembeli')
			->where('pendapatan.status_dana =', 'distributor')
			->where('distributor.user_id', user()->id)
			->find();
			$data['affiliate'] = $this->model->select('sum(COALESCE(affiliate_commission,0) - COALESCE(pendapatan.keluar,0)) AS affiliate_total')
			->join('cart_item', 'cart_item.id = detailtransaksi.cart_id ', 'left')
			->join('users', 'users.affiliate_link = cart_item.affiliate_link', 'left')
			->join('pendapatan', 'pendapatan.user_id = users.id', 'left')
			->where('status_barang =', 'diterima_pembeli')
			->where('pendapatan.status_dana =', 'affiliate')
			->where('users.id', user()->id)
			->find();

			$data['pending_stockist'] = $this->model->select('sum(COALESCE(stockist_commission,0)) as pending_stockist_total')
			->join('distributor', 'distributor.id = detailtransaksi.distributor_id ', 'left')
          	->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id AND transaksi.status_pembayaran = "paid"')
			->where('distributor.user_id', user()->id)
			->where('status_barang =', 'dikirim')
			->orWhere('status_barang =', 'dipantau')
          	->findAll();
          	
		}
		if(in_groups(4)){

			$data['pending_affiliate'] = $this->model->select('sum(COALESCE(affiliate_commission,0)) AS pending_affiliate_total')
	      	->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id AND transaksi.status_pembayaran = "paid"')
	      	->join('cart_item', 'cart_item.id = detailtransaksi.cart_id ', 'left')
	      	->join('users', 'users.affiliate_link = cart_item.affiliate_link', 'left')
			->where('users.id', user()->id)
			->where('status_barang =', 'dikirim')
			->orWhere('status_barang =', 'dipantau')
	      	->findAll();

	      	$data['affiliate'] = $this->model->select('sum(COALESCE(affiliate_commission,0)) - COALESCE(pendapatan.keluar,0) AS affiliate_total')
			->join('cart_item', 'cart_item.id = detailtransaksi.cart_id ', 'left')
			->join('users', 'users.affiliate_link = cart_item.affiliate_link', 'left')
			->join('pendapatan', 'pendapatan.user_id = users.id', 'left')
			->where('users.id', user()->id)
			->where('status_barang =', 'diterima_pembeli')
			->where('pendapatan.status_dana =', 'affiliate')
			->find();
		}

		$data['bills'] = $this->bill->findAll();
		$data['bills']   = $this->bill->paginate(4, 'bills');
		$data['pager']    = $this->bill->pager;
		return view('dashboard', $data);
	}

}
