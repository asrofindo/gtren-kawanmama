<?php

use App\Models\Profiles;

function profile()
{
	$model = new Profiles();	
    // You may need to load the model if it hasn't been pre-loaded
    $profiles = $model->first();
	return $profiles;
}