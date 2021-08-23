<?php

namespace App\Controllers;

class Authtest extends BaseController
{

	public function login()
	{
		return view('auth/login');
	}

	public function register()
	{
		return view('auth/register');
	}

}
