<?php


function rupiah($data)
{
	$hasil_rupiah = "Rp. " . number_format($data,0,',','.');
	return $hasil_rupiah;
}