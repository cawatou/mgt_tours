<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
CModule::IncludeModule("iblock");

//var_dump($_REQUEST);

if(isset($_REQUEST['id'])) {
	$ID = $_REQUEST['id'];
}
else $ID = 0;

if(isset($_REQUEST['section_id'][0])) {
	$ID_HOTEL = $_REQUEST['section_id'][0];
}
else $ID_HOTEL = 0;

if($_REQUEST['show']) {	$ACTIVE = 'Y';} else { $ACTIVE = 'N'; }

$NAME = $_REQUEST['cityz']." - ".$_REQUEST['countryz']."(".$_REQUEST['curort'].")";
$el = new CIBlockElement;
$bs = new CIBlockSection;
$arFields = Array(
	"ACTIVE" => $ACTIVE,
	//"IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
	"IBLOCK_ID" => 20,
	"NAME" => $NAME,
	"UF_DEPARTURE" => $_REQUEST['tvid'],
	"UF_GENERATED" => 1
);
if(isset($_FILES["cover"])) {
	$arFields["PICTURE"] = $_FILES["cover"];
}
if($ID>0){
	$res = $bs->Update($ID, $arFields);
	$ID_COVER = $ID;
} 
else {
	$ID_COVER = $bs->Add($arFields);
	$res = ($ID_COVER>0);
}

if(!$res){
	echo $bs->LAST_ERROR;
	die();
}
$bs = new CIBlockSection;
$arFields = Array(
	  "ACTIVE" => 'Y',
	  //"IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
	  "IBLOCK_ID" => 23,
	  "NAME" => $NAME
);

if($ID_HOTEL > 0){
	$res = $bs->Update($ID_HOTEL, $arFields);
	$SECTID_HOTEL = $ID_HOTEL;
}
else{
	$SECTID_HOTEL = $bs->Add($arFields);
	$res = ($SECTID_HOTEL>0);
}

if(!$res) {
	echo $bs->LAST_ERROR;
	die();
}



	
	$arFilter = Array("ID"=>307,"IBLOCK_ID"=>25 );
$res = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter,true, Array("ID","IBLOCK_ID","ACTIVE","NAME","UF_DEFAULTPROMO"));
$discn = $res->GetNext();
	
	$dscnt = $discn['UF_DEFAULTPROMO'];
	
	$last = 0;
	$f =0 ;
	foreach($_REQUEST['dates'] as $key=> $dates){
		
		if(!isset($dates["autoDiscount"])){
			//echo " Y ";
			$k=0;
			$discounts = array();
			$arProps = array();
			$arSelect = Array();
			$arFilter = Array("IBLOCK_ID"=>25,"PROPERTY_COUNTRY"=>$_REQUEST["countryz"],"PROPERTY_TUROPERATOR"=>$_REQUEST["turoper"],"PROPERTY_CITY"=>$_REQUEST["cityz"]);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
			while($ob = $res->GetNextElement()){
				$discounts[] = $ob->GetFields();
				$arProps = $ob->GetProperties();
				//echo "скидос ? (1)";
			}
			if(count($discounts)>0){
				$dscnt = $arProps["DISCOUNT"]["VALUE"];
				//echo " проход 1 ".$dscnt;
			}
			else {
				$arFilter = Array("IBLOCK_ID"=>25,"PROPERTY_COUNTRY"=>$_REQUEST["countryz"],"PROPERTY_TUROPERATOR"=>$_REQUEST["turoper"]);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
				while($ob = $res->GetNextElement()){
					$discounts[] = $ob->GetFields();
					$arProps = $ob->GetProperties();
					//echo "скидос ? (1)";
				}
				if(count($discounts)>0){
					$dscnt = $arProps["DISCOUNT"]["VALUE"];
					//echo " проход 2 ".$dscnt;
				}
				else {
					$arFilter = Array("IBLOCK_ID"=>25,"PROPERTY_TUROPERATOR"=>$_REQUEST["turoper"],"PROPERTY_CITY"=>$_REQUEST["cityz"]);
					$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
					while($ob = $res->GetNextElement()){
						$discounts[] = $ob->GetFields();
						$arProps = $ob->GetProperties();
						//echo "скидос ? (1)";
					}
					if(count($discounts)>0){
						if($arProps["COUNTRY"]["VALUE"]=="")
							$dscnt = $arProps["DISCOUNT"]["VALUE"];
						//echo " проход 3 ".$dscnt;
					}
					else {
						$arFilter = Array("IBLOCK_ID"=>25,"PROPERTY_TUROPERATOR"=>$_REQUEST["turoper"]);
						$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
						while($ob = $res->GetNextElement()){
							$discounts[] = $ob->GetFields();
							$arProps = $ob->GetProperties();
							//echo "скидос ? (1)";
						}
						if(count($discounts)>0){
							if($arProps["COUNTRY"]["VALUE"]==""&&$arProps["CITY"]["VALUE"]=="")
								$dscnt = $arProps["DISCOUNT"]["VALUE"];
								//echo " проход 4 ".$dscnt;
						}
					}
				}
			}
		}
		else {
			 $dscnt=0;
		}
		
		$paydop="";
		$incldops="";
		foreach($dates["paydop"] as $k=>$pd){
			if(isset($dates["paydopid"][$k])){
				if(!empty($dates["paydopid"][$k])) $paydop .= $dates["paydopid"][$k].',';
			}
			else {
				if(!empty(trim($pd))){
					$arLoadProductArray = Array(
						"MODIFIED_BY"    => $USER->GetID(),
						"IBLOCK_ID"      => 28,
						"IBLOCK_SECTION_ID" => 394,
						"NAME"           => $pd,
						"ACTIVE"         => "Y"
					);
					$PDID = $el->Add($arLoadProductArray);
					$paydop .= $PDID.',';
				}
			}
		}
		foreach($dates["incldops"] as $k=>$pd){
			if(isset($dates["incldopsid"][$k])){
				if(!empty($dates["incldopsid"][$k])) $incldops .= $dates["incldopsid"][$k].',';
			}
			else {
				if(!empty(trim($pd))){
					$arLoadProductArray = Array(
						"MODIFIED_BY"    => $USER->GetID(),
						"IBLOCK_ID"      => 28,
						"IBLOCK_SECTION_ID" => 393,
						"NAME"           => $pd,
						"ACTIVE"         => "Y"
					);
					$PDID = $el->Add($arLoadProductArray);
					
					$incldops .= $PDID.',';
				}
			}
		}

		
		//die();
		$PROP = array();
		$PROP[120] = $dscnt;
		$PROP[119] = $dates["hotel_base"][0]["price"];
		
		$PROP[121] = $dates["turoper"];

		$PROP[128] = $dates["date_from"];
		$PROP[129] = $dates["date_to"];
		
		$PROP[122] = $_REQUEST["cityz"];
		$PROP[123] = $_REQUEST["countryz"];
		if(!empty($_REQUEST["curort_new"]) )
			$PROP[124] =  $_REQUEST["curort_new"];
		else
			$PROP[124] = $_REQUEST["curort"];
		
		$PROP[125] = $dates["document"];
		$PROP[126] = $incldops;
		$PROP[127] = $paydop;

		$PROP[130] = $dates["nights"];
		$PROP[131] = $dates["peoples"];

		if(isset($dates['promoPrice'])) $PROP[135] = 1;

//$PROP[136] = $_REQUEST["link"];
//$PROP[137] = $_REQUEST["orderby"];

		$NAME = date("d.m.Y",strtotime($dates["date_from"]))."_".$ID_COVER;
		$arLoadProductArray = Array(
			"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
		  
		  "IBLOCK_ID"      => 20,
		  "IBLOCK_SECTION_ID" => $ID_COVER,
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $NAME,
		  "ACTIVE"         => "Y",            // активен
		  //"PREVIEW_TEXT"   => $small,
		  //"DETAIL_TEXT"    => $_REQUEST["more"],
		  //"PREVIEW_PICTURE" => $_FILES['cover']
		  );
		if(isset($_REQUEST['tour_id'][$f])&&$_REQUEST['tour_id'][$f]!=""){
			$res = $el->Update($_REQUEST['tour_id'][$f], $arLoadProductArray);
			$TOUR_ID = $_REQUEST['tour_id'][$f];
		}
		else{
			if($PRODUCT_ID = $el->Add($arLoadProductArray))
			{
				$TOUR_ID =  $PRODUCT_ID;
			}	 
		}
			
			$min = 1000000000;
			 $x=1;$g =1;
				foreach($dates['hotel_base'] as $j=>$hotel){
					
					
					
					
					$zx = 'pic'.$x;
					$x++;
					$json = file_get_contents('http://tourvisor.ru/xml/hotel.php?authlogin='.AUTH.'&authpass='.PASS.'&hotelcode='.$hotel["hotid"].'&reviews=1&removetags=1&format=json');

					$arz = json_decode($json);

					$img = $arz->data->hotel->images->image[0];
					if(!isset($hotel["promo"])){
						$hotel["promo"] = "N";
					}
					if(!empty($hotel["hotid"])){
						$PROP[141] = $hotel["hotid"];
					}
					else {
						$PROP[214] = $hotel["urladr"];
					}
					$PROP[143] = $_REQUEST["countryz"];
					$PROP[144] = $_REQUEST["cityz"];
					$PROP[145] = $hotel["stars"];
					$PROP[146] = $dates["nights"];
					$PROP[147] = $hotel["price"];
					$PROP[148] = $TOUR_ID;
					$PROP[152] = $hotel["meals"];
					$PROP[153] = $dates["turoper"];
					$PROP[167] = $img;
					$PROP[185] = $hotel["price"]*($dscnt/100);
					$PROP[187] = $hotel["promo"];
					
					$arLoadProductArray = Array(
						"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
						"IBLOCK_ID"      => 23,
						"IBLOCK_SECTION_ID" => $SECTID_HOTEL,
						"PROPERTY_VALUES"=> $PROP,
						"NAME"           => $hotel["name"],
						"ACTIVE"         => "Y",            // активен
						//"PREVIEW_TEXT"   => $small,
						//"DETAIL_TEXT"    => $_REQUEST["more"],
						//"PREVIEW_PICTURE" => $_FILES[$zx]
					);
					if(isset($_REQUEST['hotel_id'][$g])&&$_REQUEST['hotel_id'][$g]!=""){
						$res = $el->Update($_REQUEST['hotel_id'][$g], $arLoadProductArray);
						$HOTEL_ID = $_REQUEST['hotel_id'][$g];
						$arr["success"] = "Успешно обновлен тур!";
						$arr["description"] = " ";
					}
					else{
						if($HOTEL_ID = $el->Add($arLoadProductArray))
						{
							$arr["success"] = "Успешно добавлен тур в базу!";
							$arr["description"] = " ";
							$arr["id"] = $ID_COVER;
						}
						else{
							$arr["error"] = $el->LAST_ERROR;
						}
					}
					
					if($hotel["price"]<$min) $min = $hotel["price"];
					$g++;
				}
		if(!isset($_REQUEST['id'])) {
			$PROP[188] = $min;
		}
		$PROP[119] = $min;
		$arLoadProductArray = Array(
		  "IBLOCK_ID"      => 20,
		  "IBLOCK_SECTION_ID" => $ID_COVER,
		  "PROPERTY_VALUES"=> $PROP,
		);
		$res = $el->Update($TOUR_ID, $arLoadProductArray);
		$f++;
}



	
		

echo json_encode($arr);
