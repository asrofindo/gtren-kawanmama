<?php

namespace App\Controllers;

class Finance extends BaseController
{
	public function produk_list()
	{
		return view('db_finance/produk/produk_list');

	}
	public function kategori()
	{
		return view('db_finance/produk/kategori');
	}

	public function order()
	{
		return view('db_finance/order/order');
	}

	public function order_detail()
	{
		return view('db_finance/order/order_detail');
	}

	public function transaksi()
	{
		return view('db_finance/transaksi/transaksi');
	}

}
