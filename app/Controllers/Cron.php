<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;


class Cron extends ResourceController
{

	protected $format    = 'json';

	public function __construct()
	{
		helper('wawoo')	;
	}

    public function index()
    {
    	$db      = \Config\Database::connect();
		$builder = $db->table('transaksi');
		$detailtransaksi = $db->table('detailtransaksi');
		
		$data = $builder->select('*, detailtransaksi.id as detail_id')
		->where('batas_pesanan <', date( "Y-m-d H:i:s"))
		->join('detailtransaksi', 'detailtransaksi.transaksi_id = transaksi.id')
		->where('status_barang', null)
		->get()
		->getResult();

		foreach ($data as $d) {

			$detailtransaksi->where('id', $d->detail_id);
			$detailtransaksi->update(['status_barang' => "ditolak"]);
		}


		$data = $db->table('detailtransaksi')->select('*, detailtransaksi.id as detail_id')
		->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id', 'left')
		->join('users', 'users.id = transaksi.user_id', 'left')
		->where('detailtransaksi.status_barang', 'dikirim')
		->where('tanggal_resi >', date("Y-m-d H:i:s"))
		->get()
		->getResult();

		// $data_admin = $db->table('users')
		// ->join('auth_groups_users','auth_groups_users.user_id = users.id', 'left')
		// ->where('group_id', 1)->get()->getResult();

		// foreach ($data_admin as $d) {
			
		// }


		foreach ($data as $d) {
			
			wawoo($d->phone, 'Harap Konfirmasi Barang');

			$detailtransaksi->where('id', $d->detail_id);
			$detailtransaksi->update(['status_barang' => "dikirim"]);


		}

		 return $this->respond($detailtransaksi);
		
    }
}