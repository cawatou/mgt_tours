<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();

define("AUTH","i@neoz.su");
define("PASS","jICPOQJ7");


if(!isset($_REQUEST['countryID']) && isset($_SESSION['search_id'])) {
		$p='';
	if(isset($_REQUEST['page'])) $p = "&page=".$_REQUEST['page'];
		
	$json = file_get_contents('http://tourvisor.ru/xml/result.php?authlogin='.AUTH.'&authpass='.PASS.'&requestid='.$_SESSION['search_id'].$p.'&type=result&format=json');
	
	
	echo $json;
}
else {
	if(!isset($_REQUEST['countryID'])) die();
	
if(isset($_REQUEST['amount'])) {
	$am = str_replace("руб","",$_REQUEST['amount']);
	$am = str_replace("у.е.","",$am);
	$price_from = trim(substr($am,0,strpos($am,'-')));
	$price_to = trim(substr($am,strpos($am,'-')+2));
}
if(isset($_REQUEST['daterangefly'])) {
	$datefrom = substr($_REQUEST['daterangefly'],0,strpos($_REQUEST['daterangefly'],'-'));
	$dateto = substr($_REQUEST['daterangefly'],strpos($_REQUEST['daterangefly'],'-')+2);
	
	$_SESSION['search']['datefrom'] = $datefrom;
	$_SESSION['search']['dateto'] = $dateto;

	
	$datefrom = trim($datefrom).".".date('Y');
	$dateto = trim($dateto).".".date('Y');
	
}
else {
	$_SESSION['search']['datefrom'] = $_REQUEST['fromday'];
	$_SESSION['search']['dateto'] = $_REQUEST['today'];

	$datefrom = $_REQUEST['fromday'].".".date('Y');
	$dateto = $_REQUEST['today'].".".date('Y');
	
}
if (isset($_REQUEST['curort'])){
	foreach($_REQUEST['curort'] as $v){
		$curort = $v.',';
	}
	$curort = substr($curort, 0, -1);
}

if (isset($_REQUEST['hotel'])){
	foreach($_REQUEST['hotel'] as $v){
		$hotel = $v.',';
	}
	$hotel = substr($hotel, 0, -1);
}
if (isset($_REQUEST['operator'])){
	foreach($_REQUEST['operator'] as $v){
		$operator = $v.',';
	}
	$operator = substr($operator, 0, -1);
}
if (isset($_REQUEST['type'])){
	foreach($_REQUEST['type'] as $v){
		$type = $v.',';
		
	}
	
	$type = substr($type, 0, -1);
}


$str = "";



if(isset($_REQUEST['cityID'])) $str .='&departure='.$_REQUEST['cityID'];
if(isset($_REQUEST['countryID'])) $str .='&country='.$_REQUEST['countryID']; 
if(isset($datefrom)) $str .='&datefrom='.$datefrom;
if(isset($dateto)) $str .='&dateto='.$dateto;
if(!empty($_REQUEST['night_ot'])) $str .='&nightsfrom='.$_REQUEST['night_ot'];
if(!empty($_REQUEST['night_do'])) $str .='&nightsto='.$_REQUEST['night_do'];
if(isset($_REQUEST['adult'])) $str .='&adults='.$_REQUEST['adult'];
if(isset($_REQUEST['child'])&&$_REQUEST['child']>0) $str .='&child='.$_REQUEST['child'];
if(isset($_REQUEST['hotelstar'])) $str .='&stars='.$_REQUEST['hotelstar'];
if(!empty($_REQUEST['eats'])) $str .='&meal='.$_REQUEST['eats'];
if(!empty($_REQUEST['raiting'])) $str .='&rating='.$_REQUEST['raiting'];
if(isset($_REQUEST['hotel'])) $str .='&hotels='.$hotel;
if(isset($_REQUEST['type'])) $str .='&hoteltypes='.$type;
if(isset($_REQUEST['curort'])) $str .='&regions='.$curort;
if(isset($_REQUEST['operator'])) $str .='&operators='.$operator;
if(isset($_REQUEST['amount'])) $str .='&pricefrom='.$price_from;
if(isset($_REQUEST['amount'])) $str .='&priceto='.$price_to;
if(isset($_REQUEST['curency'])) $str .='&currency='.$_REQUEST['curency'];
if(isset($_REQUEST['child1'])) $str .='&childage1 ='.$_REQUEST['child1'];
if(isset($_REQUEST['child2'])) $str .='&childage2='.$_REQUEST['child2'];
if(isset($_REQUEST['child3'])) $str .='&childage3='.$_REQUEST['child3'];
if(isset($_REQUEST['child4'])) $str .='&childage4='.$_REQUEST['child4'];


$json = file_get_contents('http://tourvisor.ru/xml/search.php?authlogin='.AUTH.'&authpass='.PASS.$str.'&format=json');

//echo $str;

$arr = json_decode($json);

$_SESSION['search_id'] = $arr->result->requestid;
$_SESSION['search'] = $_REQUEST;

echo $json;

}

?>