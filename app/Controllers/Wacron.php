<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;


class Wacron extends ResourceController
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


		$data = $db->table('detailtransaksi')->select('*, detailtransaksi.id as detail_id')
		->join('transaksi', 'transaksi.id = detailtransaksi.transaksi_id', 'left')
		->join('users', 'users.id = transaksi.user_id', 'left')
		->where('detailtransaksi.status_barang', 'dipantau')
		->where('tanggal_resi <', date("Y-m-d H:i:s"))
		->get()
		->getResult();

		$data_admin = $db->table('users')
		->join('auth_groups_users','auth_groups_users.user_id = users.id', 'left')
		->where('group_id', 1)->get()->getResult();

		

		if(count($data) > 0){
			foreach ($data_admin as $d) {
				wawoo($d->phone, 'Ada User Yang Belum Konfirmasi');
			}
		}

		 return $this->respond($detailtransaksi);
		
    }
}