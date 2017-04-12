<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
$IBLOCK_ID = 20;

if($_REQUEST['action']=='copy') {
	echo ($_REQUEST['id']+1);
}
if($_REQUEST['action']=='delete') {
	
}
?>