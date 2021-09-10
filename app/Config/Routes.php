<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Commerce');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->resource('city');
$routes->resource('province');
$routes->resource('subdistrict');

$routes->get('/product/(:any)/src/(:num)', 'Product::detail/$1/$2');
$routes->post('/comment/save', 'Comment::save');
$routes->get('/comment/delete/(:num)','Comment::delete/$1');
$routes->get('/transaksi','Transaksi::transaksi');

$routes->get('/make/admin/(:num)', 'User::admin/$1');
$routes->get('/delete/admin/(:num)', 'User::admin/$1');

$routes->get('/','Product::commerce');
// $routes->get('cart', 'User::cart', ['filter' => 'login']);
$routes->get('account', 'User::account', ['filter' => 'login']);
$routes->get('orders', 'User::orders', ['filter' => 'login']);
$routes->get('detail/(:num)', 'User::order_detail/$1', ['filter' => 'login']);
$routes->get('tracking', 'User::tracking', ['filter' => 'login']);

//addresses
$routes->get('billing-address', 'User::address', ['filter' => 'login']);
$routes->post('billing-address/(:num)', 'User::save_billing/$1', ['filter' => 'login']);

$routes->get('shipping-address', 'User::address', ['filter' => 'login']);
$routes->post('shipping-address/(:num)', 'User::save_shipping/$1', ['filter' => 'login']);
$routes->get('edit-billing', 'User::address', ['filter' => 'login']);
$routes->get('edit-shipping', 'User::address', ['filter' => 'login']);
$routes->get('address/delete/(:num)', 'User::delete/$1', ['filter' => 'login']);
$routes->post('edit-billing/(:num)', 'User::edit_billing/$1', ['filter' => 'login']);
$routes->post('edit-shipping/(:num)', 'User::edit_shipping/$1', ['filter' => 'login']);


$routes->get('address', 'User::address', ['filter' => 'login']);

// profile
$routes->get('profile', 'User::profile', ['filter' => 'login']);
$routes->post('profile', 'User::set_profile', ['filter' => 'login']);

$routes->get('upgrade/affiliate', 'User::upgrade_affiliate', ['filter' => 'login']);
$routes->get('upgrade/stockist', 'User::upgrade_stockist', ['filter' => 'login']);
$routes->post('track', 'User::Track', ['filter' => 'login']);

$routes->get('contact', 'Commerce::Contact');
$routes->get('about', 'Commerce::About');
$routes->get('cart', 'Commerce::cart');
$routes->post('cart', 'Cart::save');
$routes->post('cart/(:num)', 'Cart::save/$1');

$routes->get('cart/delete/(:num)', 'Cart::delete/$1');
$routes->get('cart/delete/all', 'Cart::delete_all');
$routes->get('cart/add/(:num)', 'Cart::add/$1');
$routes->get('cart/substruct/(:num)', 'Cart::substruct/$1');

$routes->get('product/(:any)', 'Product::detail/$1');
$routes->get('category/product/(:any)', 'Product::productByCategory/$1');
$routes->get('category/delete/(:any)', 'Category::delete/$1');
$routes->post('category/update/(:any)', 'Category::update/$1');

$routes->get('test', 'Testing::index');
$routes->post('testfoto', 'Testing::testfoto');

$routes->get('bills', 'Bill::index');
$routes->post('bills', 'Bill::index');
$routes->get('bills/add', 'Bill::add');
$routes->get('bills/edit/(:num)', 'Bill::edit/$1');
$routes->post('bills/update/(:num)', 'Bill::update/$1');
$routes->get('bills/delete/(:num)', 'Bill::delete/$1');



$routes->group('', ['namespace' => 'Myth\Auth\Controllers'], function($routes) {
    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');
});




$routes->group('', function($routes)
{
	$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'login','filter' => 'role:admin,stockist']);
	// produk
	$routes->get('tambahproduk', 'Product::tambah_produk', ['filter' => 'login','filter' => 'role:admin']);
	$routes->post('tambahproduk', 'Product::save', ['filter' => 'login','filter' => 'role:admin']);
	$routes->get('saveproduk', 'Product::save');
	$routes->get('products/stockist', 'Product::stockist');
	$routes->get('products/stockist/edit/(:num)/(:num)', 'Product::edit_distributor_produk/$1/$2');
	$routes->post('products/stockist/edit/(:num)/(:num)', 'Product::edit_distributor_produk/$1/$2');
	$routes->get('products/update/stock/(:num)', 'Product::update_stock/$1');
	$routes->get('products/delete/stock/(:num)', 'Product::delete_stock/$1');
	$routes->get('products/delete/(:num)', 'Product::delete/$1', ['filter' => 'login','filter' => 'role:admin']);
	$routes->get('products/edit/(:num)', 'Product::edit/$1', ['filter' => 'login','filter' => 'role:admin, stockist']);
	$routes->get('products', 'Product::index');
	$routes->post('products/search', 'Product::search');
	$routes->get('products/search', 'Product::search');
	$routes->post('updateproduk/(:any)', 'Product::update/$1', ['filter' => 'login','filter' => 'role:admin']);
	$routes->get('products/delete_photo/(:num)/(:any)', 'Product::delete_photo/$1/$2', ['filter' => 'login','filter' => 'role:admin']);
	$routes->get('products/delete_category/(:num)/(:any)', 'Product::delete_category/$1/$2', ['filter' => 'login','filter' => 'role:admin']);

	// kategori
 //    $routes->get('kategori/(:alpha)/(:num)', 'Admin::kategori/$1/$2');
	// $routes->get('kategori', 'Admin::kategori');
    $routes->get('category', 'Category::index');
    $routes->get('category/edit/(:num)', 'Category::edit/$1');
    $routes->post('category/save', 'Category::save/$1');
	$routes->post('category/save', 'Category::save');
    $routes->get('category/edit/(:num)', 'Category::edit/$1');

	// order
	$routes->get('order', 'Admin::order');
	$routes->get('order/refund/(:num)/(:num)', 'Order::order_refund/$1/$2');
	$routes->post('order/update/(:num)', 'Order::update/$1');
	$routes->get('orderdetail/(:num)', 'Admin::order_detail/$1');


	// order stockist
		// order
	$routes->get('order/stockist', 'Admin::order_stockist');
	$routes->get('order/verify/(:num)', 'Order::order_verify/$1');
	$routes->post('stockist/save/resi', 'Order::save_resi');
	$routes->post('order/stockist/update/(:num)', 'Order::update/stockist/$1');
	$routes->get('order/acc/(:num)', 'Order::order_acc/$1');
	$routes->get('order/ignore/(:num)', 'Order::order_ignore/$1');
	$routes->get('orderdetail/stockist/(:num)', 'Admin::order_detail/stockist/$1');

	// member g-tren
	$routes->get('members', 'Member::index', ['as' => 'member']);
	$routes->post('members', 'Member::index');
	$routes->get('members/(:any)', 'Member::detail/$1');

	$routes->post('add/role/(:any)', 'Member::addRole/$1');

	$routes->get('role/delete/(:any)/(:any)', 'Member::deleteRole/$1/$2');
	$routes->get('user/delete/(:any)', 'Member::deleteUser/$1');
	$routes->get('user/active/(:any)', 'Member::activeUser/$1');
	$routes->get('user/nonactive/(:any)', 'Member::nonActiveUser/$1');

	$routes->get('user/upgrade', 'User::upgradeList');
	$routes->get('user/action/(:alpha)/(:num)', 'User::action/$1/$2');

	// Banner
	$routes->get('banner', 'Banner::index');
	$routes->post('banner', 'Banner::save');
	$routes->get('banner/delete/(:num)', 'Banner::delete/$1');
	$routes->get('banner/edit/(:num)', 'Banner::edit/$1');
	$routes->post('banner/update/(:num)', 'Banner::update/$1');

		// offer
	$routes->get('offer', 'Offer::index');
	$routes->post('offer', 'Offer::save');
	$routes->get('offer/delete/(:num)', 'Offer::delete/$1');
	$routes->get('offer/edit/(:num)', 'Offer::edit/$1');
	$routes->post('offer/update/(:num)', 'Offer::update/$1');
	$routes->post('offer/search', 'Offer::search');

		// contact
	$routes->get('contact', 'Contact::index');
	$routes->post('contact', 'Contact::save');
	$routes->get('contact/delete/(:num)', 'Contact::delete/$1');
	$routes->get('contact/edit/(:num)', 'Contact::edit/$1');
	$routes->post('contact/update/(:num)', 'Contact::update/$1');
	$routes->post('contact/search', 'Contact::search');


		// upgrades
	$routes->get('upgrades', 'Upgrades::index');
	$routes->post('upgrades/(:num)', 'Upgrades::save/$1');
	$routes->get('upgrades/delete/(:num)', 'Upgrades::delete/$1');
	$routes->get('upgrades/edit/(:num)', 'Upgrades::edit/$1');
	$routes->get('upgrades/update/(:num)', 'Upgrades::update/$1');
	$routes->post('upgrades/upload/(:num)', 'Upgrades::upload/$1');
	$routes->post('upgrades/search', 'Upgrades::search');

	$routes->get('distributor', 'Distributor::index');
	$routes->post('distributor', 'Distributor::save');
	$routes->post('distributor/detail', 'Distributor::save_toko');
	$routes->post('distributor/(:num)', 'Distributor::edit/$1');

	$routes->get('checkout', 'Transaksi::index');
	$routes->post('transaksi/kurir', 'Transaksi::save_kurir');
	$routes->post('transaksi/check', 'Transaksi::check');
	$routes->post('transaksi/save', 'Transaksi::save_transaction');

	$routes->get('hutang/stockist', 'Transaksi::hutang_stockist');
	$routes->get('hutang/affiliate', 'Transaksi::hutang_affiliate');
	$routes->post('transaksi/wd', 'Transaksi::wd');

}
);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
