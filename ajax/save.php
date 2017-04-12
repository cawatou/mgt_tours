<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
GLOBAL $USER;
if (!CModule::IncludeModule("sale")) die('Нет возможности подключить модуль');

function getAge($brth){
	$brth= strtotime($brth);
	$d = date('d',$brth);
	$m = date('m',$brth);
	$y = date('Y',$brth);

	if($m > date('m') || $m == date('m') && $d > date('d'))
		return (date('Y') - $y - 1);
	else
		return (date('Y') - $y);
}

//var_dump($_REQUEST);


if(!empty($USER->GetID())) {
	$uid = $USER->GetID();

}
else {
	for($i=0;$i<=count($_REQUEST["sex"])-1;$i++){
		if(isset($_REQUEST["imorder"][$i])) {
			
		}
	}
	
	$arr['login'] = "i".mt_rand(100000,999999);
	$arr['pass'] = 'Tour23ru!';
	
	$user = new CUser;
	$arFields = Array(
	  "NAME"              =>  $_REQUEST["firstname"][0],
	  "LAST_NAME"         =>  $_REQUEST["lastname"][0],
	  "EMAIL"             => $_REQUEST["email"][0],
	  "LOGIN"             => $arr['login'],
	  "LID"               => "ru",
	  "ACTIVE"            => "Y",
	  "GROUP_ID"          => array(5),
	  "PASSWORD"          => $arr['pass'],
	  "CONFIRM_PASSWORD"  => $arr['pass'],
	 // "PERSONAL_PHOTO"    => $arIMAGE
	);

$ID = $user->Add($arFields);
if (intval($ID) > 0) {
	$uid = $ID;
	$USER->Authorize($ID);
}
	
else
    echo $user->LAST_ERROR;
	
	
}

/*  если не зареген - зарегить */
$arFields = array(
   "LID" => "s1",
   "PERSON_TYPE_ID" => 1,
   "PAYED" => "N",
   "CANCELED" => "N",
   "STATUS_ID" => "N",
   "PRICE" => $_REQUEST["price"],
   "CURRENCY" => "RUB",
   "USER_ID" => IntVal($uid),
   "PAY_SYSTEM_ID" => 9,
   "TAX_VALUE" => 0.0,
   "USER_DESCRIPTION" => "заказан тур ".$_REQUEST["tourid"]." От  ",
);

// add Guest ID
if (CModule::IncludeModule("statistic"))
   $arFields["STAT_GID"] = CStatistic::GetEventParam();

$ORDER_ID = CSaleOrder::Add($arFields);

//echo $ORDER_ID;
//$ORDER_ID = IntVal($ORDER_ID);

$el = new CIBlockElement;
for($i=0;$i<=count($_REQUEST["sex"])-1;$i++){
	$PROP[172] = $_REQUEST["sex"][$i];
	$PROP[173] = $_REQUEST["lastname"][$i];
	$PROP[174] = $_REQUEST["firstname"][$i];
	$PROP[175] = $_REQUEST["daybirt"][$i];
	$PROP[176] = $_REQUEST["citizen"][$i];
	$PROP[177] = $_REQUEST["doctype"][$i];
	$PROP[178] = $_REQUEST["docsernom"][$i];
	$PROP[179] = $_REQUEST["docbefore"][$i];
	$PROP[180] = $_REQUEST["docwhogive"][$i];
	$PROP[181] = $_REQUEST["phone"][$i];
	$PROP[182] = $_REQUEST["adres"][$i];
	$PROP[183] = $_REQUEST["email"][$i];
	$PROP[184] = $ORDER_ID;
	
	
	$arLoadProductArray = Array(
		"MODIFIED_BY"    => $uid, 
		  
		"IBLOCK_ID"      => 27,
		"PROPERTY_VALUES"=> $PROP,
		"NAME"           => $_REQUEST["lastname"][$i]." ".$_REQUEST["firstname"][$i]." ".getAge($_REQUEST["daybirth"][$i])." лет",
		"ACTIVE"         => "Y",
	);
	
	if($GUEST_ID = $el->Add($arLoadProductArray)) 
		$arr['g'.$i] = $GUEST_ID;
}
$arr['suc'] = 'ok';
$arr['id'] = $ORDER_ID;

echo json_encode($arr);