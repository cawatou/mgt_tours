<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();

CModule::IncludeModule("iblock");
/*
echo "<pre>";
var_dump($_FILES);
var_dump($_REQUEST);
echo "</pre>";
*/
$el = new CIBlockElement;
$PROP = array();

if($_REQUEST["mysex"]=='Мужской') $my=1; else $my=2;
if($_REQUEST["whosex"]=='Мужской') $wh=3; else $wh=4;

$PROP[91] = $_REQUEST["imya"];
$PROP[92] = $_REQUEST["phone"];
$PROP[93] = $_REQUEST["email"];
$PROP[94] = array("VALUE"=>$my);
$PROP[95] = $_REQUEST["age"];
$PROP[96] = $_REQUEST["link"];
$PROP[97] = $_REQUEST["city"];
$PROP[98] = $_REQUEST["citys"];
$PROP[99] = array("VALUE"=>$wh);
$PROP[100] = $_REQUEST["country"];
$PROP[101] = $_REQUEST["flydate"];
$PROP[102] = $_REQUEST["count"];
$PROP[103] = $_REQUEST["lastdate"];
$small = substr($_REQUEST["more"],0,100);
$arLoadProductArray = Array(
	//"MODIFIED_BY"    => $USER->GetID(),
	"IBLOCK_ID"      => 17,
	"PROPERTY_VALUES"=> $PROP,
	"NAME"           => $_REQUEST["imya"],
	"ACTIVE"         => "N",
	"PREVIEW_TEXT"   => $small,
	"DETAIL_TEXT"    => $_REQUEST["more"],
	"PREVIEW_PICTURE" => $_FILES['upload'],
	"DATE_ACTIVE_TO" => $_REQUEST["lastdate"]
);

 if($PRODUCT_ID = $el->Add($arLoadProductArray))
  echo "Ваша анкета принята к поиску";//echo "New ID: ".$PRODUCT_ID;
else
  echo "Error: ".$el->LAST_ERROR;