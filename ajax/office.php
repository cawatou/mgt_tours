<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();

$arr = array();
CModule::IncludeModule("iblock");
		$arSelect1 = Array("ID","NAME","IBLOCK_ID","PROPERTY_*");
		$arFilter1 = Array("IBLOCK_ID"=>16,"SECTION_ID"=>IntVal($_REQUEST['city']));
		$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, Array("nPageSize"=>50), $arSelect1);

		$i =0;
$PLACEMARKS = array();
		$ob = $res1->GetNextElement();
		
		 $arFields2 = $ob->GetFields();
		 
		// var_dump($arFields2);
			  
		  
		 
		// print_r($arFields2);
		 $arProps = $ob->GetProperties();
		 //print_r($arProps['office_latlong']);
		
		$MAP = explode(",", $arProps["office_latlong"]["VALUE"]);
		$PLACEMARKS[$i]["LON"] = $MAP[1]; //Заполняем массив маркера данными
        $PLACEMARKS[$i]["LAT"] = $MAP[0];
		$PLACEMARKS[$i]["TEXT"] = $arProps['office_address']['VALUE'];
		
		$jobOffice = $arFields2['ID'];
		
		
$arr['id'] = $arFields2['ID'];
$arr['name'] = $arFields2['NAME'];

$arr['addr'] = $arProps['office_address']['VALUE'];

$arr['hours'] = $arProps['office_hours']['VALUE'];
$arr['holiday'] = $arProps['office_holiday']['VALUE'];
$arr['phone'] = $arProps['office_phone']['VALUE'];
$arr['phone2'] = $arProps['office_phone2']['VALUE'];

$arSelect1 = Array("ID","NAME","IBLOCK_ID","PREVIEW_PICTURE","PROPERTY_*");
		$arFilter1 = Array("IBLOCK_ID"=>7,"PROPERTY_OFFICE"=>IntVal($jobOffice));
		$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, Array("nPageSize"=>50), $arSelect1);

		
	$i=0;
		while($ob = $res1->GetNextElement()){
		
			 $arFields2 = $ob->GetFields();
			
			 $arProps = $ob->GetProperties();
			 
			$arr['employ'][$i]['img'] =  CFile::GetPath($arFields2["PREVIEW_PICTURE"]);
			
			$arr['employ'][$i]['name'] = $arFields2['NAME'];
			$arr['employ'][$i]['post'] = $arProps["POST"]["VALUE"];
		
				$i++;		
		}
	$arr['placemark']	= $PLACEMARKS;
	$arr['lon']	= $MAP[1];
	$arr['lat']	= $MAP[0];
echo json_encode($arr);