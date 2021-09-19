<?php

namespace App\Controllers;
use App\Models\OtpModel;

interface OTP {
  public function save();
}

interface OTPRequest {
  public function request();
}

interface OTPSend {
  public function send();
}

interface OTPValidate {
  public function validate();
}

interface OTPDelete {
  public function delete();
}


class RequestOtp implements  OTPRequest {

  public function __construct($value='')
  {
    $this->model = new OtpModel();
    $this->data = $value;
  }
  public function request()
  {
    $randOtp = rand(10000, 99999);

    $this->model->save([
      "user_id" => user()->id,
      "otp" => $randOtp,
      "expired" => date( "Y-m-d H:i:s", strtotime( "+1 hour"))
    ]);
    return $randOtp;
  }
}


class ValidateOtp  implements OTPValidate {
  public function __construct($value='')
  {
    $this->model = new OtpModel();
    $this->data = $value;
  }

  public function validate(){
    $data['user'] = $this->model->where('user_id', user()->id);
    return $data;
  }
}

class SendOtp  implements OTPSend {
  public function __construct($value='')
  {
    $this->model = new OtpModel();
    $this->otp = $value;
    helper('wawoo');
  }
  public function send(){
        $user_id = user()->id;
        $phone = $this->model->join('users', "users.id = user_id", 'left')->where('user_id', $user_id)->first()->phone;
        wawoo($phone, "Kode OTP {$this->otp}");
        return 'berhasil';
  }
}

class DeleteOtp  implements OTPDelete {
  public function __construct($value='')
  {
    $this->model = new OtpModel();
    $this->otp = $value;
  }
  public function delete(){
       $this->model->delete($this->otp);
  }
}


class OtpType extends BaseController
{

  public function InitializeOtp($data, $value='')
  {
    if($value == 'request'){
      return new RequestOtp($data);
    }

    if($value == 'validate'){

      return new ValidateOtp($data);
    }

    if($value == 'send'){

      return new SendOtp($data);
    }

    if($value == 'delete'){

      return new DeleteOtp($data);
    }

  }

}