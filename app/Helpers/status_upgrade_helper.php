<?php 

function status($status)
{
	switch ($status) {
		case 'pending':
			return "<span class='badge bg-warning text-white'>$status</span>";
			break;
		case 'approved':
			return "<span class='badge bg-success text-white'>Disetujui</span>";
			break;
		default:
			return "<span class='badge bg-danger text-white'>Ditolak</span>";
			break;
	}
}