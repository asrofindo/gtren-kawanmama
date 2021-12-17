<?php

use App\Models\CartItemModel;

function cart($id = '')
{
	$model = new CartItemModel();	
    // You may need to load the model if it hasn't been pre-loaded
    if($id > 0){
	    $carts = $model->where('user_id', $id)->where('status', null)->find();
		return $carts;
    } else {
    	return [];
    }
}