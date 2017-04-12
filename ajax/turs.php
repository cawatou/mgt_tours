<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
$IBLOCK_ID = 20;

if($_REQUEST['action']=='copy') {

	CModule::IncludeModule('iblock');

	$id = $_REQUEST['id'];

	$resource = CIBlockElement::GetByID($id);
	if ($ob = $resource->GetNextElement())
	{
	   $arFields = $ob->GetFields();
	   $arFields['PROPERTIES'] = $ob->GetProperties();
	   
	   $arFields = array_reverse($arFields);
		$arFields = array_combine(preg_replace('/^~/', '', array_keys($arFields)), $arFields);
	   
	   $arFieldsCopy = $arFields;
	   
	   
	   $arFieldsCopy['PROPERTY_VALUES'] = array();
	   
	   foreach ($arFields['PROPERTIES'] as $property)
	   {
		  $arFieldsCopy['PROPERTY_VALUES'][$property['CODE']] = $property['VALUE'];
	   }
	   
	   unset($arFieldsCopy['~'],$arFieldsCopy['ID'], $arFieldsCopy['TMP_ID'], $arFieldsCopy['WF_LAST_HISTORY_ID'], $arFieldsCopy['SHOW_COUNTER'], $arFieldsCopy['SHOW_COUNTER_START']);
	   	   
	   $el = new CIBlockElement();
	   $NEW_ID = $el->Add($arFieldsCopy);
	   
	   echo $NEW_ID;
	}
}
if($_REQUEST['action']=='delete') {
	$strWarning = "";
	if(CIBlock::GetPermission($IBLOCK_ID)>='W')
	{
		$DB->StartTransaction();
		if(!CIBlockSection::Delete($id))
		{
			$strWarning .= 'Error!';
			$DB->Rollback();
		}
		else
			$DB->Commit();
	}
	echo $strWarning;
}
if($_REQUEST['action']=='sort') {
	
	$el = new CIBlockElement;

	$arLoadProductArray = Array(
		"SORT"         => $_REQUEST['sort'],         
		
	  
	);

$res = $el->Update($id, $arLoadProductArray);

}
?>