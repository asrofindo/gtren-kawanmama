<?php


function wawoo($phone='+6281232312288',$message='permisi kami dari Gtren')
{
	$db      = \Config\Database::connect();
	$builder = $db->table('api_key');

	$api = $builder->where('name', 'woowa')->get()->getResultObject()[0];
	
	$key= $api->token; //this is demo key please change with your own key
	$url='http://116.203.191.58/api/send_message';
	$data = array(
	"phone_no"=> $phone,
	"key"		=>$key,
	"message"	=>$message,
	"skip_link"	=>true // This optional for skip snapshot of link in message
	);
	$data_string = json_encode($data);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 360);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen($data_string))
	);
	curl_exec($ch);
	curl_close($ch);
	return $data_string;
}

function hp($nohp) {
	// kadang ada penulisan no hp 0811 239 345
	$nohp = str_replace(" ","",$nohp);
	// kadang ada penulisan no hp (0274) 778787
	$nohp = str_replace("(","",$nohp);
	// kadang ada penulisan no hp (0274) 778787
	$nohp = str_replace(")","",$nohp);
	// kadang ada penulisan no hp 0811.239.345
	$nohp = str_replace(".","",$nohp);

	// cek apakah no hp mengandung karakter + dan 0-9
	if(!preg_match('/[^+0-9]/',trim($nohp))){
		// cek apakah no hp karakter 1-3 adalah +62
		if(substr(trim($nohp), 0, 3)=='+62'){
			$hp = trim($nohp);
		}
		// cek apakah no hp karakter 1 adalah 0
		elseif(substr(trim($nohp), 0, 1)=='0'){
			$hp = '+62'.substr(trim($nohp), 1);
		}
	}
	return $hp;
}
?>