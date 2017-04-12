<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
global $USER,$User_city;
CModule::IncludeModule("iblock");
/*
echo "<pre>";
var_dump($_FILES);
var_dump($_REQUEST);
echo "</pre>";
*/
$el = new CIBlockElement;
$PROP = array();

if($USER->GetID()){
	//$imya = $_REQUEST["imya"];
	$PROP[69] = $USER->GetID();
	$imya =  "Отзыв от юзера #". $USER->GetID();
}
else {
	$PROP[91] = $_REQUEST["imya"];
	$PROP[212] = $_REQUEST["phone"];
	$PROP[68] = $_REQUEST["email"];
	
	
	$imya = $_REQUEST["imya"];
}

$PROP[213] = $User_city['city'];

$small = substr($_REQUEST["more"],0,100);

$arLoadProductArray = Array(
	//"MODIFIED_BY"    => $USER->GetID(),
	"IBLOCK_ID"      => 12,
	"PROPERTY_VALUES"=> $PROP,
	"NAME"           => $imya,
	"ACTIVE"         => "N",
	"PREVIEW_TEXT"   => $small,
	"DETAIL_TEXT"    => $_REQUEST["more"],
	
);

if(isset($_FILES['upload']))
	$arLoadProductArray["PREVIEW_PICTURE"] = $_FILES['upload'];

 if($PRODUCT_ID = $el->Add($arLoadProductArray))
  echo "ok";//echo "New ID: ".$PRODUCT_ID;
else
  echo "Error: ".$el->LAST_ERROR;
