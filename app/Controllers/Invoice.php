<?php

namespace App\Controllers;
use Xendit\Xendit;
use App\Models\TransaksiModel;





class Invoice extends BaseController
{
	public function __construct()
	{
		helper('rupiah', 'api');
		$this->transaksi = new TransaksiModel();
	}
	public function index($id)
	{	
		// token
		Xendit::setApiKey(api()[0]->token);
		// end
		
		// models
			$transaksi = new TransaksiModel();
		// end

		// get data transaksi
			$data['transaksi'] = $transaksi->where('payment_id', $id)->first();
		// end

		// jika VIrtual Account
			if($data['transaksi']->payment_type == 'VIRTUAL_ACCOUNT'){
				$getVA = \Xendit\VirtualAccounts::retrieve($id, []);
				$data['invoice'] = $getVA;
			}
		// end

		// jika retail outlite
			if($data['transaksi']->payment_type == 'RETAIL_OUTLET'){
				$getFPC = \Xendit\Retail::retrieve($id);
				$data['invoice'] = $getFPC;
			}
		// end

		// jika ewallet 
			if($data['transaksi']->payment_type == 'EWALLET'){
				$getEWalletChargeStatus = \Xendit\EWallets::getEWalletChargeStatus($id,[]);
				$data['invoice'] = $getEWalletChargeStatus;
			}
		// end


		// jika QRIS 
			if($data['transaksi']->payment_type == 'QRIS'){
			    $qr_code = \Xendit\QRCode::get($id);
				$data['invoice'] = $qr_code;
			}
		// end

		// get produk transaksi

			// id transaksi
			$t_id = $data['transaksi']->id;
			$user_id = user()->id;
			// end

			$data['details_order'] = $this->transaksi->select('*, detailtransaksi.id as id')
			->join('detailtransaksi', "detailtransaksi.transaksi_id = transaksi.id")
			->join('cart_item', "detailtransaksi.cart_id = cart_item.id AND cart_item.user_id = {$user_id}")
			->join('products', 'products.id = cart_item.product_id')
			->join('detailpengiriman', 'detailpengiriman.cart_id = cart_item.id')
			->join('pengiriman', 'detailpengiriman.pengiriman_id = pengiriman.id')
			->where('transaksi.id', $t_id)
			->find();
			
		// end
		return view('invoice/index', $data);
	}

}
