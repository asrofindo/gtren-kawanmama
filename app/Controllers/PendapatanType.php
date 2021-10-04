<?php

namespace App\Controllers;
use App\Models\PendapatanModel;
use App\Models\RekeningModel;

interface SavePendapatan {
  public function save();

}

class UserSavePendapatan implements SavePendapatan {

  	public function __construct($data = '', $type = '')
  	{
  		$this->pendapatan = new PendapatanModel();
  		$this->data = $data;
  		$this->type = $type;
  	}

  	public function save() {

  		$data = [
  			"user_id" => $this->data->user_id,
  			"masuk" => $this->data->admin_commission + $this->data->affiliate_commission + $this->data->stockist_commission,
  			"keluar" => null,
  			"total" => $this->data->admin_commission + $this->data->affiliate_commission + $this->data->stockist_commission,
  			"status_dana" => $this->type,
  		];

  		$this->pendapatan->save($data);
  	}
}

class UserUpdatePendapatan implements SavePendapatan {

  	public function __construct($data = '', $type = '',$dataBefore)
  	{
  		$this->pendapatan = new PendapatanModel();
  		$this->data = $data;
  		$this->id = $dataBefore->id;
  		$this->dataBefore = $dataBefore;
  	}

  	public function save() {

  		$data = [
  			"id" => $this->id,
  			"masuk" => $this->dataBefore->masuk + $this->data->admin_commission + $this->data->affiliate_commission + $this->data->stockist_commission,
  			"total" => $this->dataBefore->total + $this->data->admin_commission + $this->data->affiliate_commission + $this->data->stockist_commission,
  		];

  		$this->pendapatan->save($data);
  	}
}

class UserSaveToRekening implements SavePendapatan {

	public function __construct($value='', $data_rekening = '')
	{
		$this->rekening = new RekeningModel();
		$this->data = $value;
		$this->data_rekening = $data_rekening;
	}

	public function save()
	{	
		$data = [
			"id" => $this->data_rekening->id,
  			"total" => intval($this->data->admin_commission + $this->data->affiliate_commission + $this->data->stockist_commission + $this->data_rekening->total),
  		];

  		$this->rekening->save($data);
	}
}

class UserCreatePendapatan implements SavePendapatan {

  public function __construct($data = '', $type = '')
    {
      $this->pendapatan = new PendapatanModel();
      $this->data = $data;
      $this->type = $type;
    }

    public function save() {

      $data = [
        "user_id" => $this->data->user_id,
        "masuk" => $this->data->kode_unik,
        "keluar" => null,
        "total" => $this->data->kode_unik,
        "status_dana" => $this->type,
      ];

      $this->pendapatan->save($data);
    }
}

class UserPendapatan implements SavePendapatan {

  public function __construct($val = '', $type = '', $data = '')
    {
      $this->pendapatan = new PendapatanModel();
      $this->data = $data;
      $this->type = $type;
      $this->val = $val;
    }

    public function save() {

      $data = [
        "id" => $this->data->id,
        "masuk" => $this->data->masuk + $this->val->kode_unik ,
        "total" => $this->data->total + $this->val->kode_unik ,
      ];

      $this->pendapatan->save($data);
    }
}


class PendapatanType extends BaseController
{
	public function initializePendapatan($value='', $type = '')
	{
		$pendapatan = new PendapatanModel();

		$data['data_pendapatan'] = $pendapatan->where('status_dana', $type)->where('user_id', $value->user_id)->first();
    if($data['data_pendapatan'] == null && $type == 'user'){
      return new UserCreatePendapatan($value, $type);
    } 
    if($data['data_pendapatan'] != null && $type == 'user') {
      return new UserPendapatan($value, $type, $data['data_pendapatan']);
    }
		if($data['data_pendapatan'] == null){
			return new UserSavePendapatan($value, $type);
		} else {
			return new UserUpdatePendapatan($value, $type, $data['data_pendapatan']);
		}
	}



	public function initializeBank($value='', $type = '')
	{
		$rekening = new RekeningModel();

		$data['data_rekening'] = $rekening->where('user_id', $value->user_id)->first();

		if($data['data_rekening'] != null){
			return new UserSaveToRekening($value, $data['data_rekening']);
		} 
	}
}
