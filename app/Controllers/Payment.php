<?php

namespace App\Controllers;
use Xendit\Xendit;

interface Pay {
  public function createPayment();
  public function refundPayment();
  public function checkPayment();
}

/**
 * 
 */
class RetailPayment implements Pay {  

  public function __construct($data)
  {
    helper('api');

    // models
    $this->detail_transaksi_model = $data['detail_transaksi_model'];
    $this->transaksi_model = $data['transaksi_model'];
    $this->cart_model = $data['cart_model'];
    $this->bill_model = $data['bill'];
    // end 

    // payment channel atau payment gateway
    $this->payment_channel = $data['payment_channel'];
    // data keranjang yang akan di checkout
    $this->data_checkout = $data['data_checkout'];
    // data yang carts yang sudah dijoinkan satu sama lain
    $this->carts = $data['carts'];
  }

  public function createPayment()
  {
  

    // get bill id
    $bill = $this->bill_model->where('bank_name','xendit')->first();
    // end

    // insert data to transaksi
    $this->transaksi_model->insert([
        "user_id" => $this->data_checkout['user_id'], 
        "kode_unik" => $this->data_checkout['kode_unik'], 
        "bill_id" => $bill->id, 
        "status_pembayaran" => "pending", 
        "total" => $this->data_checkout['total'], 
        "alamat" => $this->data_checkout['alamat'],
        "payment_type" => "RETAIL_OUTLET"
    ]);
    // end

  // api key
    Xendit::setApiKey(api()[0]->token);
    // end
    
    // create payment 
    $eks = $this->transaksi_model->getInsertID();
    $params = [
        'external_id' => "{$eks}",
        'retail_outlet_name' => $this->payment_channel['channel_code'],
        'name' => user()->fullname,
        'expected_amount' => $this->data_checkout['total']
    ];
    $createFPC = \Xendit\Retail::create($params);
    // end

    // insert payment id
      $this->transaksi_model->save(["id" => $this->transaksi_model->getInsertID(), "payment_id" => $createFPC['id']]);
    // end

    // loop for insert data checkout
    foreach($this->carts as $cart){    
        // data 
        $data = [
          "id" => $cart->cart_id,
          "status" => "checkout"
        ];  
        // end

        // save cart
        $this->cart_model->save($data);
        // end

        // data untuk komisi dan lain2
        $data = [
            "cart_id" => $cart->cart_id, 
            "affiliate_commission" => $cart->affiliate_link != null ? ($cart->affiliate_commission * $cart->amount)  : $cart->affiliate_link  , 
            "distributor_id" => $cart->distributor_id, 
            "stockist_commission" => $cart->affiliate_link == null ? ($cart->affiliate_commission * $cart->amount) + ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk : ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk , 
            "admin_commission" => ($cart->sell_price * $cart->amount) - ($cart->fixed_price * $cart->amount) - ($cart->stockist_commission * $cart->amount) - ($cart->affiliate_commission * $cart->amount),
            "transaksi_id" => $this->transaksi_model->getInsertID() 
        ];
        // end

        // inser data to detail transaksi
        $this->detail_transaksi_model->save($data);
        // end
    }
    // end
    return $createFPC['id'];

  }
   public function refundPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
   public function checkPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
}

class VAPayment implements Pay {  

  public function __construct($data)
  {
    
    $this->detail_transaksi_model = $data['detail_transaksi_model'];
    $this->transaksi_model = $data['transaksi_model'];
    $this->cart_model = $data['cart_model'];
    $this->bill_model = $data['bill'];
    // end 

    // payment channel atau payment gateway
    $this->payment_channel = $data['payment_channel'];
    // data keranjang yang akan di checkout
    $this->data_checkout = $data['data_checkout'];
    // data yang carts yang sudah dijoinkan satu sama lain
    $this->carts = $data['carts'];
  }

  public function createPayment()
  {
   

    // get bill id
    $bill = $this->bill_model->where('bank_name','xendit')->first();
    // end

    // insert data to transaksi
    $this->transaksi_model->insert([
        "user_id" => $this->data_checkout['user_id'], 
        "kode_unik" => $this->data_checkout['kode_unik'], 
        "bill_id" => $bill->id, 
        "status_pembayaran" => "pending", 
        "total" => $this->data_checkout['total'], 
        "alamat" => $this->data_checkout['alamat'],
        "payment_type" => "VIRTUAL_ACCOUNT" 
    ]);
    // end

    // create payment 
      Xendit::setApiKey(api()[0]->token);
      $eks = $this->transaksi_model->getInsertID();

      $params = [
        "is_closed" => true,
        "external_id" => "{$eks}",
         "bank_code" =>$this->payment_channel['channel_code'] ,
         "name" => user()->fullname,
         "expiration_date" => date('Y-m-d\TH:i:sO', strtotime('+1')),
         "expected_amount" => $this->data_checkout['total'],
      ];

      $createVA = \Xendit\VirtualAccounts::create($params);
    // end

    // save payment id to database 
      $this->transaksi_model->save(["id" => $eks, "payment_id" => $createVA['id']]);
    // end

    // loop for insert data checkout
    foreach($this->carts as $cart){    
        // data 
        $data = [
          "id" => $cart->cart_id,
          "status" => "checkout"
        ];  
        // end

        // save cart
        $this->cart_model->save($data);
        // end

        // data untuk komisi dan lain2
        $data = [
            "cart_id" => $cart->cart_id, 
            "affiliate_commission" => $cart->affiliate_link != null ? ($cart->affiliate_commission * $cart->amount)  : $cart->affiliate_link  , 
            "distributor_id" => $cart->distributor_id, 
            "stockist_commission" => $cart->affiliate_link == null ? ($cart->affiliate_commission * $cart->amount) + ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk : ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk , 
            "admin_commission" => ($cart->sell_price * $cart->amount) - ($cart->fixed_price * $cart->amount) - ($cart->stockist_commission * $cart->amount) - ($cart->affiliate_commission * $cart->amount),
            "transaksi_id" => $this->transaksi_model->getInsertID() 
        ];
        // end

        // inser data to detail transaksi
        $this->detail_transaksi_model->save($data);
        // end
    }
    // end
    return $createVA['id'];


  }
   public function refundPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
   public function checkPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
}

class eWalletPayment implements Pay {  

  public function __construct($data)
  {
    Xendit::setApiKey(api()[0]->token);
    // models
    $this->detail_transaksi_model = $data['detail_transaksi_model'];
    $this->transaksi_model = $data['transaksi_model'];
    $this->cart_model = $data['cart_model'];
    $this->bill_model = $data['bill'];
    // end 

    // payment channel atau payment gateway
    $this->payment_channel = $data['payment_channel'];
    // data keranjang yang akan di checkout
    $this->data_checkout = $data['data_checkout'];
    // data yang carts yang sudah dijoinkan satu sama lain
    $this->carts = $data['carts'];
  }

  public function createPayment()
  {

    // get bill id
    $bill = $this->bill_model->where('bank_name','xendit')->first();
    // end

    // insert data to transaksi
    $this->transaksi_model->insert([
        "user_id" => $this->data_checkout['user_id'], 
        "kode_unik" => $this->data_checkout['kode_unik'], 
        "bill_id" => $bill->id, 
        "status_pembayaran" => "pending", 
        "total" => $this->data_checkout['total'], 
        "alamat" => $this->data_checkout['alamat'],
        "payment_type" => "EWALLET" 
    ]);
    // end

    // create payment 
    $id = $this->transaksi_model->getInsertID();
      $ewalletChargeParams = [
        'reference_id' => "{$id}",
        'currency' => 'IDR',
        'amount' => intVal($this->data_checkout['total']), 
        'checkout_method' => 'ONE_TIME_PAYMENT',
        'channel_code' => "ID_{$this->payment_channel['channel_code']}",
        'channel_properties' => [
            'success_redirect_url' => 'http://localhost:8080/orders',
            'mobile_number' => user()->phone
        ],
        'metadata' => [
            'meta' => 'data'
        ]
      ];

      $createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
      var_dump($createEWalletCharge);
    // end

    // insert payment 
      $this->transaksi_model->save(["id" => $this->transaksi_model->getInsertID(), "payment_id" => $createEWalletCharge['id']]);
    // end

    // loop for insert data checkout
    foreach($this->carts as $cart){    
        // data 
        $data = [
          "id" => $cart->cart_id,
          "status" => "checkout"
        ];  
        // end

        // save cart
        $this->cart_model->save($data);
        // end

        // data untuk komisi dan lain2
        $data = [
            "cart_id" => $cart->cart_id, 
            "affiliate_commission" => $cart->affiliate_link != null ? ($cart->affiliate_commission * $cart->amount)  : $cart->affiliate_link  , 
            "distributor_id" => $cart->distributor_id, 
            "stockist_commission" => $cart->affiliate_link == null ? ($cart->affiliate_commission * $cart->amount) + ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk : ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk , 
            "admin_commission" => ($cart->sell_price * $cart->amount) - ($cart->fixed_price * $cart->amount) - ($cart->stockist_commission * $cart->amount) - ($cart->affiliate_commission * $cart->amount),
            "transaksi_id" => $this->transaksi_model->getInsertID() 
        ];
        // end

        // inser data to detail transaksi
        $this->detail_transaksi_model->save($data);
        // end
    }
    // end

    return $createEWalletCharge['id'];


  }
   public function refundPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
   public function checkPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
}

class QRISPayment implements Pay {  

  public function __construct($data)
  {
    Xendit::setApiKey(api()[0]->token);
    // models
    $this->detail_transaksi_model = $data['detail_transaksi_model'];
    $this->transaksi_model = $data['transaksi_model'];
    $this->cart_model = $data['cart_model'];
    $this->bill_model = $data['bill'];
    // end 

    // payment channel atau payment gateway
    $this->payment_channel = $data['payment_channel'];
    // data keranjang yang akan di checkout
    $this->data_checkout = $data['data_checkout'];
    // data yang carts yang sudah dijoinkan satu sama lain
    $this->carts = $data['carts'];
  }

  public function createPayment()
  {

    // get bill id
    $bill = $this->bill_model->where('bank_name','xendit')->first();
    // end

    // insert data to transaksi
    $this->transaksi_model->insert([
        "user_id" => $this->data_checkout['user_id'], 
        "kode_unik" => $this->data_checkout['kode_unik'], 
        "bill_id" => $bill->id, 
        "status_pembayaran" => "pending", 
        "total" => $this->data_checkout['total'], 
        "alamat" => $this->data_checkout['alamat'],
        "payment_type" => "QRIS" 
    ]);
    // end

    // create payment 
    $eks = $this->transaksi_model->getInsertID();
    $params = [
        'external_id' => "{$eks}",
        'is_closed' => true,
        'type' => 'STATIC',
        'callback_url' => 'https://6b11-125-160-98-44.ngrok.io/pay',
        'amount' => 10000,
        'expiration_date' =>  date('Y-m-d\TH:i:sO', strtotime('+1'))
    ];

    $qr_code = \Xendit\QRCode::create($params);
    // end

    // insert payment 
      $this->transaksi_model->save(["id" => $eks, "payment_id" => $eks]);
    // end

    // loop for insert data checkout
    foreach($this->carts as $cart){    
        // data 
        $data = [
          "id" => $cart->cart_id,
          "status" => "checkout"
        ];  
        // end

        // save cart
        $this->cart_model->save($data);
        // end

        // data untuk komisi dan lain2
        $data = [
            "cart_id" => $cart->cart_id, 
            "affiliate_commission" => $cart->affiliate_link != null ? ($cart->affiliate_commission * $cart->amount)  : $cart->affiliate_link  , 
            "distributor_id" => $cart->distributor_id, 
            "stockist_commission" => $cart->affiliate_link == null ? ($cart->affiliate_commission * $cart->amount) + ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk : ($cart->stockist_commission * $cart->amount) +  ($cart->fixed_price * $cart->amount) + $cart->ongkir_produk , 
            "admin_commission" => ($cart->sell_price * $cart->amount) - ($cart->fixed_price * $cart->amount) - ($cart->stockist_commission * $cart->amount) - ($cart->affiliate_commission * $cart->amount),
            "transaksi_id" => $this->transaksi_model->getInsertID() 
        ];
        // end

        // inser data to detail transaksi
        $this->detail_transaksi_model->save($data);
        // end
    }
    // end

    return $qr_code['external_id'];


  }
   public function refundPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
   public function checkPayment()
  {
    dd($this->payment_channel);
    return $value;
  }
}


class Payment extends BaseController
{
  public function InitializeCreatePayment($data, $value='')
  {
    if($value == 'VIRTUAL_ACCOUNT') return new VAPayment($data);
    if($value == 'RETAIL_OUTLET') return new RetailPayment($data);
    if($value == 'EWALLET') return new eWalletPayment($data);
    if($value == 'QRIS') return new QRISPayment($data);
  }

}