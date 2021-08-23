<?php


function greeting($name)
{
	date_default_timezone_set("Asia/Jakarta");

	//ambil jam dan menit
	$jam = date('H:i');

	//atur salam menggunakan IF
	if ($jam > '05:30' && $jam < '10:00') {
	    $salam = 'Selamat Pagi ';
	} elseif ($jam >= '10:00' && $jam < '15:00') {
	    $salam = 'Selamat Siang ';
	} elseif ($jam < '18:00') {
	    $salam = 'Selamat Sore ';
	} else {
	    $salam = 'Selamat Malam ';
	}

	return $salam. $name;
}