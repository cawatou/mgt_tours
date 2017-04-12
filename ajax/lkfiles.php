<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
CModule::IncludeModule("iblock");

if(isset($_REQUEST['id']))
{
	if($_REQUEST['action']=='del'){
		if(CIBlock::GetPermission($IBLOCK_ID)>='W')
		{
			$DB->StartTransaction();
			if(!CIBlockElement::Delete($_REQUEST['id']))
			{
				echo 'Error!';
				$DB->Rollback();
			}
			else
				$DB->Commit();
			
			echo 'ok';
		}
	}
	if($_REQUEST['action']=='send'){
		$arSelect = array();
		$arFilter = Array("IBLOCK_ID"=>26,"ID"=>$_REQUEST['id']);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arFieldz = $ob->GetFields();
			$arProps = $ob->GetProperties();
			
		}
		echo CFile::GetPath($arProps['DOCUMENT']['VALUE']);
	}
	if($_REQUEST['action']=='print'){
		$arSelect = array();
		$arFilter = Array("IBLOCK_ID"=>26,"ID"=>$_REQUEST['id']);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arFieldz = $ob->GetFields();
			$arProps = $ob->GetProperties();
			
		}
		echo CFile::GetPath($arProps['DOCUMENT']['VALUE']);
	}
	if($_REQUEST['action']=='download'){
		$arSelect = array();
		$arFilter = Array("IBLOCK_ID"=>26,"ID"=>$_REQUEST['id']);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arFieldz = $ob->GetFields();
			$arProps = $ob->GetProperties();
			
		}
		echo CFile::GetPath($arProps['DOCUMENT']['VALUE']);
	}
}
if(isset($_FILES['upload']))
{
	$el = new CIBlockElement;

	$PROP[162] = $_FILES['upload'];
	$PROP[163] = $USER->GetID();
	//$PROP[164] = $dates["nights"];
	if(isset($_REUQEST['isfile']))
	{
		$PROP[165] = 'Y';
	}
	else 
	{
		$PROP[165] = 'N';
	}
	$NAME = $_REQUEST['docname'];
	
	$arLoadProductArray = Array(
		"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем

		"IBLOCK_ID"      => 26,
		"PROPERTY_VALUES"=> $PROP,
		"NAME"           => $NAME,
		"ACTIVE"         => "Y",            // активен
		//"PREVIEW_TEXT"   => $small,
		//"DETAIL_TEXT"    => $_REQUEST["more"],
		//"PREVIEW_PICTURE" => $_FILES['cover']
	);

	if($PRODUCT_ID = $el->Add($arLoadProductArray))
	{
		$arr['id'] = $PRODUCT_ID;
		$arr['date'] = date('d.m.Y');
		$arr['success'] = 'ok';

	}
	else
	{
		$arr['er'] = 'somthing wrong';
	}
	
	echo json_encode($arr);
}