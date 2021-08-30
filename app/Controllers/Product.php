<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\BannerModel;
use App\Models\ProductPhoto;
use App\Models\CategoryModel;
use App\Models\OfferModel;
use App\Models\ContactModel;
use App\Libraries\Slug;


class Product extends BaseController
{
	protected $category;
	protected $data;

	public function __construct()
	{
		helper(['form', 'url']);

		$this->model    = new ProductModel();
		$this->photo    = new ProductPhoto();
		$this->banner    = new BannerModel();
		$this->offer    = new OfferModel();
		$this->contact    = new ContactModel();
		
		$this->category = new CategoryModel();
		$this->data['category']    = $this->category->findAll();

	}

	public function index()
	{


		$data['categories'] = $this->category->findAll();
		$data['products']   = $this->model->paginate(15, 'products');
		
		$data['pager']      = $this->model->pager;
		
		return view('db_admin/produk/produk_list', $data);
	}

	public function commerce()
	{
		$data = $this->data;
		$data['products']   = $this->model->paginate(8, 'products');
		
		$data['kategori'] = $this->category->findAll();

		$data['banners'] = $this->banner->findAll();

		$data['offers'] = $this->offer->findAll();

		$data['contacts'] = $this->contact->findAll();

		$data['pager']      = $this->model->pager;

		// dd($data['categories']);

		return view('commerce/home', $data);

	}

	public function detail($slug)
	{
		$data = $this->data;

		$data['product'] = $this->model->where('slug', $slug)->first();

		// dd($data['product']);
		return view('commerce/product_detail', $data);
	}

	public function edit($id)

	{
		$db = \Config\Database::connect();
		$builder = $db->table('categories');

		$product['product'] = $this->model->find($id);

		$categories_id = $this->model->find($id)->categories; //[1,2,3]
		$product['product_categories'] = $product['product']->getCategory($categories_id); //[adasdad,asdasd,asdasd]

		$id_categories = [];
		

		foreach($product['product_categories'] as $c ){
			array_push($id_categories, $c->id);
		}

		$categories = $builder->whereNotIn('id', $id_categories);
		if(count($id_categories) != 0) {
			$product['categories'] = $categories->get()->getResult(); //[4,5]
			return view('db_admin/produk/edit_produk', $product);

		} 
		else {
			$product['categories'] = $this->category->findAll(); //[4,5]

			return view('db_admin/produk/edit_produk', $product);
		}
		

	}

	public function update($id)

	{
		$product    = new \App\Entities\Product();
		$slug       = new Slug();
		$photos     = $this->model->find($id)->photos;
		$categories = $this->model->find($id)->categories;
		$validation =  \Config\Services::validation();
		$validation->setRules(
			[
				'name'                 => "required|is_unique[products.name, id, $id]",
				'description'          => 'required',
				'fixed_price'          => 'required',
				'sell_price'           => 'required',
				'affiliate_commission' => 'required',
				'stockist_commission'  => 'required',
				'file'                 => 'max_size[file,1024]|ext_in[file,png,jpg]',
			],
			[
	        	'name' => [
    				'required'  => 'Nama Produk Harus Diisi',
    				'is_unique' => 'Nama Produk Sudah Ada'
    			],
    			'description' => [
    				'required' => 'Deskripsi Produk Harus Diisi'
    			],
    			'fixed_price' => [
    				'required' => 'Harga Tetap Harus Diisi'
    			],
    			'sell_price' => [
    				'required' => 'Harga Jual Harus Diisi'
    			],
    			'affiliate_commission' => [
    				'required' => 'Komisi Affiliate Harus Diisi'
    			],
    			'stockist_commission' => [
    				'required' => 'Komisi Stokis Harus Diisi'
    			],
    			'file' => [
					'max_size' => 'Ukuran Gambar Maksimal 1Mb',
					'ext_in'   => 'Ekstensi Gambar Tidak Diizinkan',
    			],
	        ]
		);

		$isDataValid = $validation->withRequest($this->request)->run();


		if ($isDataValid) {

			if($this->request->getPost('category') != null){
				
				if($categories[0] == ''){
					$categories[0] = implode(",", $this->request->getPost('category'));
				} else {
					array_push($categories, implode(",", $this->request->getPost('category')));
				}
			}
			

			if($photos[0] == ''){
				$photos = [];
			}

			if ($this->request->getFileMultiple('file') != null) {

				foreach($this->request->getFileMultiple('file') as $file)
				{   
					if($file->getName() != ''){
						$new_name = $file->getRandomName();
						$file->move(ROOTPATH . 'public/uploads/product_photos', $new_name);

						array_push($photos, $new_name);
						 
					}
				}
			}

			$data = [
				'id'                   => $id,
				'name'                 => $this->request->getPost('name'),
				'description'          => $this->request->getPost('description'),
				'categories'           => $categories,
				'slug'                 => $this->request->getPost('name'),
				'photos'               => $photos,
				'fixed_price'          => $this->request->getPost('fixed_price'),
				'sell_price'           => $this->request->getPost('sell_price'),
				'affiliate_commission' => $this->request->getPost('affiliate_commission'),
				'stockist_commission'  => $this->request->getPost('stockist_commission')
			];


			$product->fill($data);

			$save_product = $this->model->save($product);

			if(!$save_product) {
				$data['categories'] = $this->category->findAll();
				$data['errors']     = $this->model->errors();
		        return view('db_admin/produk/tambah_produk', $data); 
		    }
		    session()->setFlashdata('success', 'Data Berhasil Disimpan');
		    return redirect()->to(base_url('/products'));
		} else {
			return redirect()->back()->withInput()->with('errors', $this->model->errors());
		}
	}

	public function delete($id)
	{	

		$path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/product_photos/';

		$files = $this->model->find($id);

		$photos = $files;

		$files = glob($path.'*');

		foreach($files as $file){
	      if(is_file($file))
	        unlink($file); 
    	}   

        $delete_product = $this->model->delete($id);

        foreach($photos as $file){
	      	$delete_photo = $this->photo->delete($file->id);
    	} 

        if($delete_product) {
	        session()->setFlashdata('success', 'Data Berhasil Dihapus');
	        return redirect()->to(base_url('/products'));
	    } else {
	        session()->setFlashdata('danger', 'Data Gagal Dihapus');
	        return redirect()->to(base_url('/products')); 
	    }

		return view('db_admin/produk/produk_list');
	}

	public function save()
	{
		$db         = db_connect('default'); 
		$slug       = new Slug();
		$product    = new \App\Entities\Product();
		$validation =  \Config\Services::validation();
		$validation->setRules(
			[
				'name'                 => 'required|is_unique[products.name]',
				'description'          => 'required',
				'fixed_price'          => 'required',
				'sell_price'           => 'required',
				'affiliate_commission' => 'required',
				'stockist_commission'  => 'required',
				'file'                 => 'uploaded[file]|max_size[file,1024]|ext_in[file,png,jpg]',
			],
			[
	        	'name' => [
    				'required'  => 'Nama Produk Harus Diisi',
    				'is_unique' => 'Nama Produk Sudah Ada'
    			],
    			'description' => [
    				'required' => 'Deskripsi Produk Harus Diisi'
    			],
    			'fixed_price' => [
    				'required' => 'Harga Tetap Harus Diisi'
    			],
    			'sell_price' => [
    				'required' => 'Harga Jual Harus Diisi'
    			],
    			'affiliate_commission' => [
    				'required' => 'Komisi Affiliate Harus Diisi'
    			],
    			'stockist_commission' => [
    				'required' => 'Komisi Stokis Harus Diisi'
    			],
    			'file' => [
					'uploaded' => 'Anda Harus Menyertakan Gambar Produk',
					'max_size' => 'Ukuran Gambar Maksimal 1Mb',
					'ext_in'   => 'Ekstensi Gambar Tidak Diizinkan',
    			],
	        ]
		);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
        	

			$photos     = [];
			$categories = array(
			    'categories' => implode(",", $this->request->getPost('category'))
			);

			if ($this->request->getFileMultiple('file')) {

				foreach($this->request->getFileMultiple('file') as $file)
				{   

					$new_name = $file->getRandomName();

					$file->move(ROOTPATH . 'public/uploads/product_photos', $new_name);

					array_push($photos, $new_name);

				}
			}

			$data = [
				'name'                 => $this->request->getPost('name'),
				'description'          => $this->request->getPost('description'),
				'categories'           => $categories,
				'slug'                 => $this->request->getPost('name'),
				'photos'               => $photos,
				'fixed_price'          => $this->request->getPost('fixed_price'),
				'sell_price'           => $this->request->getPost('sell_price'),
				'affiliate_commission' => $this->request->getPost('affiliate_commission'),
				'stockist_commission'  => $this->request->getPost('stockist_commission')
			];

			$product->fill($data);


			$save_product = $this->model->save($product);


			if(!$save_product) {
				$data['categories'] = $this->category->findAll();
				$data['errors']     = $this->model->errors();
		        return view('db_admin/produk/tambah_produk', $data); 
		    }
		    session()->setFlashdata('success', 'Data Berhasil Disimpan');
		    return redirect()->to(base_url('/products'));

        } else {

			return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }




	}

	public function tambah_produk()
	{
		$data['categories'] = $this->category->findAll();

		return view('db_admin/produk/tambah_produk', $data);
	}

	public function delete_photo($id, $photo)
	{
		$photos = $this->model->find($id)->photos;
		
		$uns    = $photos[$photo];


		$path   = $_SERVER['DOCUMENT_ROOT'] . '/uploads/product_photos/';
		
		
		if(file_exists($path.$uns)){

			unlink($path.$uns); 

		}

		unset($photos[$photo]);

		$data = [
		    'id'       => $id,
		    'photos' => implode(",", $photos)
		];

  		if($this->model->save($data)){
  			return redirect()->back();
  		}

	}

	public function delete_category($id, $category)
	{



		$categories = $this->model->find($id)->categories;
		print_r(array_filter($categories, 'strlen'));
		unset($categories[$category]);
		$data = [
		    'id'       => $id,
		    'categories' => implode(",", $categories)
		];
  		if($this->model->save($data)){
  			return redirect()->back();
  		}
	}

	public function productByCategory($id)
	{
		$data = $this->data;
		$category =new \App\Entities\category();
		$id=(int)$id;
		$data['products']= $category->getProduct([$id]);;
		
		return view('commerce/product_category',$data);
	}
}
