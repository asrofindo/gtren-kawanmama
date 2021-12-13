<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Cronjob extends BaseController
{


	public function index()
	{

		return view('db_admin/cron/cron');
	}

}
