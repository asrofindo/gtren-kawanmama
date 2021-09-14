<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;


class Cron extends ResourceController
{

	protected $format    = 'json';

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

		 return $this->respond($data);
		
    }
}