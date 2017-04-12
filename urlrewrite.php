<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/catalog/country/tid([0-9]+)#",
		"RULE" => "TID=$1",
		"ID" => "",
		"PATH" => "/catalog/country/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/country/bx([0-9]+)#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/catalog/country/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/hotel/([0-9]+)#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/catalog/hotel/index.php",
	),
	array(
		"CONDITION" => "#^/content/articles/([0-9]+)/#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/content/articles/index.php",
	),
	array(
		"CONDITION" => "#^/order/([0-9]+)#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/order/index.php",
	),
	array(
		"CONDITION" => "#^/search/([0-9]+)#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/search/index.php",
	),
	array(
		"CONDITION" => "#^/content/order/([0-9]+)#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/content/order/index.php",
	),
	array(
		"CONDITION" => "#^/content/employe/([0-9]+)/#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/content/employe/index.php",
	),
	array(
		"CONDITION" => "#^/content/map/([0-9]+)/#",
		"RULE" => "ID=$1",
		"ID" => "",
		"PATH" => "/content/map/index.php",
	),
	array(
		"CONDITION" => "#^/content/articles/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/articles/index.php",
	),
	array(
		"CONDITION" => "#^/content/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/news/index.php",
		"SORT" => "100",
	),
	array(
		"CONDITION" => "#^/content/faq/#",
		"RULE" => "",
		"ID" => "bitrix:support.faq",
		"PATH" => "/content/faq/index.php",
		"SORT" => "100",
	),
);

?>