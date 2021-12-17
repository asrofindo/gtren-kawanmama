<?php

function api()
{
	$db      = \Config\Database::connect();
	$builder = $db->table('api_key');	

	$data = $builder->where('name', 'xendit')->get()->getResultObject();
	return $data;
    
}