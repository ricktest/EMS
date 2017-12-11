
<?php
header("Content-Type:text/html; charset=utf-8");
$key='VTNTT2llZTRoV3lETzk4Zw==';

$data['version']='1.0'; //預設帶入1
$data['serial']='0000000001'; //序號為識別每次傳送的資訊，開發者應於第一次傳送時帶0000000001，並於每次送出資訊時將值加上1。
$data['action']='qryCarrierAgg'; //qryCarrierAgg
$data['cardType']='3J0002'; //3J0002手機條碼 1K0001悠遊卡 1H0001一卡通 2G0001愛金卡 其它
$data['cardNo']='/ABC.122';
$data['cardEncrypt']='34aw13W1';
$data['appID']='EINV8201703158254';

$data['timeStamp']=strtotime("now")+10; //時間戳記建議加10，如取得時間戳記為1334499000則送至系統應為1334499010。
$data['uuid']=uniqid();
//$string='action=qryCarrierAgg&appID=EINV8201703158254&cardEncrypt=asd97520&cardNo=/+64W3VR&cardType=3J0002&serial=00000000001&timeStamp='.$data['timeStamp'].'&uuid='.$data['uuid'].'&version=1.0';
//$string='appID=EINV8201703158254&barcode=/+64W3VR&invoiceDateS=20140101&invoiceDateE=20151010&verifyCode=asd97520';
$data['signature']=getSignature($string,$key);
//print_r($data);

//$url='http://api.einvoice.nat.gov.tw/PB2CAPIVAN/Carrier/Aggregate?'.$string.'&signature='.$data['signature'].'';
//$url='https://sip.einvoice.nat.gov.tw/ods-main/ODS371I/query?'.$string.'';
$string='version=1.0&action=bcv&barCode=/6U0IVU2&TxID=20171205001&appId=EINV8201703158254';
$url='http://www-vc.einvoice.nat.gov.tw/BIZAPIVAN/biz?'.$string;

$url=str_replace ("+","%2B",$url);
echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
//curl_setopt($ch, CURLOPT_POST, 1);// Doing a regular HTTP POST
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($ch);

// Get the response from the server		


$response = curl_exec($ch);
//print_r($data);
var_dump(($response));


function getSignature($str, $key) {  
	echo $str.'</br>';
	$signature = "";  
	if (function_exists('hash_hmac')) {  
		$signature = base64_encode(hash_hmac("sha1", $str, $key, true));  
	} else {  
		
	}  
	echo $signature.'</br>';
	return $signature;  
}  
//printf("uniqid(): %s\r\n", );
?>