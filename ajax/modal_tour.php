<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
// Покупка тура онлайн
if(isset($_REQUEST['pay_online'])){
	GLOBAL $arrFilter;
	$arrFilter = array(
		'PROPERTY_tourid' =>$_REQUEST['tourid']
	);
	$APPLICATION->IncludeComponent("bitrix:news.list",
		"modal_onlinetour",
		array(
			"IBLOCK_ID" => 20,
			"PROPERTY_CODE" => array(),
			"FILTER_NAME" => 'arrFilter',
			"CACHE_TYPE" => 'N',
			"PRICE_CODE" => array("BASE"),
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
		),
		false
	);
}

// Заявка на покупку тура в офисе
if(isset($_REQUEST['pay_office'])){
	GLOBAL $arrFilter;
	$arrFilter = array(
		'PROPERTY_tourid' =>$_REQUEST['tourid']
	);
	$APPLICATION->IncludeComponent("bitrix:news.list",
		"modal_officetour",
		array(
			"IBLOCK_ID" => 20,
			"PROPERTY_CODE" => array(),
			"FILTER_NAME" => 'arrFilter',
			"CACHE_TYPE" => 'N',
			"PRICE_CODE" => array("BASE"),
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
		),
		false
	);
}
?>