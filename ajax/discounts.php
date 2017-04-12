<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
$arr = array();

if(isset($_REQUEST["id"])) 
{
	if(CIBlock::GetPermission(25)>='W')
	{
		$DB->StartTransaction();
		if(!CIBlockElement::Delete($_REQUEST["id"]))
		{
			echo 'Error!';
			$DB->Rollback();
		}
		else
			$DB->Commit();
	}
}
else
{
	//var_dump($_REQUEST);

	$discountDefault = $_REQUEST["dscntDef"];
	$promoDefault = $_REQUEST["promoDef"];
	$el = new CIBlockElement;
	$bs = new CIBlockSection;
	$arFields = Array(
	  "IBLOCK_ID" => 25,
	  "UF_DEFAULTPROMO" => $promoDefault
	);
	$res = $bs->Update(308, $arFields);


	$arFields = Array(
	  "IBLOCK_ID" => 25,
	  "UF_DEFAULTPROMO" => $discountDefault
	);
	$res = $bs->Update(307, $arFields);

	for($i=0;$i<=count($_REQUEST["country"])-1;$i++)
	{
		$PROP[155] = $_REQUEST["country"][$i];
		$PROP[156] = $_REQUEST["operator"][$i];
		$PROP[157] = $_REQUEST["departure"][$i];
		$PROP[158] = $_REQUEST["price_min"][$i];
		$PROP[159] = $_REQUEST["price_max"][$i];
		$PROP[160] = $_REQUEST["discount"][$i];
		if(isset($_REQUEST["promo"][$i]))
		{
			$PROP[161] = 'Y';
			$discnt = 308;
		}
		else {
			$PROP[161] = 'N';
			$discnt = 307;
		}
		
		
		
		$arLoadProductArray = Array(
			"MODIFIED_BY"    => $USER->GetID(),
			  
			"IBLOCK_ID"      => 25,
			"IBLOCK_SECTION_ID" => $discnt,
			"PROPERTY_VALUES"=> $PROP,
			"NAME"           => time(),
			"ACTIVE"         => "Y",
			  //"PREVIEW_TEXT"   => $small,
			  //"DETAIL_TEXT"    => $_REQUEST["more"],
			  //"PREVIEW_PICTURE" => $_FILES['cover']
			  );
			  
		
		if(isset($_REQUEST['discountId'][$i]))
		{
			$res = $el->Update($_REQUEST['discountId'][$i], $arLoadProductArray);
		}
		else 
		{
			$PRODUCT_ID = $el->Add($arLoadProductArray);
			
			
		}
		$arr["success"] = "Изменения внесены";
		$arr["description"] = " ";
		$arr["er"] = $el->LAST_ERROR;
	}

	echo json_encode($arr);
}