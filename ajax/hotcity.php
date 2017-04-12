<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();


$turs = array();
				$arSelect = Array("ID","IBLOCK_ID","TIMESTAMP_X","NAME","PREVIEW_PICTURE","PROPERTY_COUNTRY","PROPERTY_PRICE","PROPERTY_CURORT","PROPERTY_DAYCOUNT","PROPERTY_DATEFROM","PROPERTY_DEPARTURE");
				$arFilter = Array("IBLOCK_ID"=>20, "PROPERTY_DEPARTURE"=> $_REQUEST['city'] );
				$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false,Array("nPageSize"=>10000),$arSelect);
				while($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					$t["id"] = $arFields['ID'];
					$t["pic"] = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
					$t["country"] = $arFields['PROPERTY_COUNTRY_VALUE'];
					$t["curort"] = $arFields['PROPERTY_CURORT_VALUE'];
					$t["price"] = $arFields['PROPERTY_PRICE_VALUE'];
					$t["dayfrom"] = FormatDateFromDB($arFields['PROPERTY_DATEFROM_VALUE'],"DD.MM");
					$t["daycnt"] = $arFields['PROPERTY_DAYCOUNT_VALUE'];
					$t["modify"] = FormatDateFromDB($arFields['TIMESTAMP_X'],"DD F в HH:MI");
					$turs[]= $t;
				}	
				
echo json_encode($turs);