<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();

$APPLICATION->IncludeComponent("bitrix:support.faq.element.list","tour",Array(
				"IBLOCK_TYPE" => "services", 
				"IBLOCK_ID" => "13", 
				"SHOW_RATING" => "Y", 
				"RATING_TYPE" => "like_graphic",
				"PATH_TO_USER" => "",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"CACHE_GROUPS" => "Y", 
				"AJAX_MODE" => "N", 
				"SECTION_ID" => $_REQUEST['id'], 
				"AJAX_OPTION_JUMP" => "N", 
				"AJAX_OPTION_STYLE" => "Y", 
				"AJAX_OPTION_HISTORY" => "N" 
			)
		);?>