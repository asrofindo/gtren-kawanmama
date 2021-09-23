<?php


function rupiah($data=0)
{
	$hasil_rupiah = "Rp. " . number_format($data,0,',','.');
	return $hasil_rupiah;
}