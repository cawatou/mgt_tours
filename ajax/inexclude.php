<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
CModule::IncludeModule("iblock");

	$x=0;
	$arFields3 = array();
	$arProps3 = array();
	$arSelect3 = Array("ID","IBLOCK_ID","NAME");
	$arFilter3 = Array("IBLOCK_ID"=>28);
	$res3 = CIBlockElement::GetList(Array(), $arFilter3, false, Array("nPageSize"=>50), $arSelect3);
	
	while($ob = $res3->GetNextElement()){
		$arFields3 = $ob->GetFields();
		$hot['list'][$x] = array("label" => $arFields3["NAME"], "value" => $arFields3["NAME"], "id" => $arFields3["ID"]);     

		$x++;
	}
 $response = $_GET["callback"] . "(" . json_encode($hot) . ")";
    echo $response;