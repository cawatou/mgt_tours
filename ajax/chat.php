<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
if(isset($_REQUEST['id'])) {
	$arr = array();
	$arr['msg'] = array();
	
	$k=0;
	$arSelect = Array();
	$arFieldz = Array();
	$arFilter = Array("IBLOCK_ID"=>26,"PROPERTY_THEME"=>$_REQUEST['id']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while($ob = $res->GetNextElement()){
		$arFieldz = $ob->GetFields();
		$arProps = $ob->GetProperties();
		
		//var_dump($arProps)
		
		$arr['fio']= $USER->NAME;
		$arr['msg'][$k]['pic']= $USER->PICTURE;
		$arr['msg'][$k]['txt']= $arFieldz['PREVIEW_TEXT'];
		if($arProps['DOCUMENT']['VALUE']!==NULL) $arr['msg'][$k]['file']= $arProps['DOCUMENT']['VALUE'];
		$arr['msg'][$k]['time']= date('d.m.Y',strtotime($arFieldz['DATE_CREATE']));
		
		$k++;
	}
	
	if(count($arr['msg'])==0) {
		$arr['err']= "еще нет сообщений в этом чате";
	}
	
	
	
	echo json_encode($arr);
}
if(isset($_REQUEST['chatmsg'])) {
	
	
	
	$el = new CIBlockElement;

	if(isset($_FILES['chatfile'])) $PROP[162] = $_FILES['chatfile'];
	$PROP[163] = $USER->GetID();
	if(isset($_REUQEST['isfile']))
	{
		$PROP[165] = 'Y';
	}
	else 
	{
		$PROP[165] = 'N';
	}
	$PROP[166] = $_REQUEST['chatid'];
	
	//$NAME = $_REQUEST['docname'];
	$NAME = "ответ в чат ".$_REQUEST['chatid']." от ".date('d-m-Y H:i:s');
	if(isset($_REQUEST['chatmsg'])) $text =$_REQUEST['chatmsg']; else $text ="";
	
	$arLoadProductArray = Array(
		"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем

		"IBLOCK_ID"      => 26,
		"PROPERTY_VALUES"=> $PROP,
		"NAME"           => $NAME,
		"ACTIVE"         => "Y",            // активен
		"PREVIEW_TEXT"   => $text,
		//"DETAIL_TEXT"    => $_REQUEST["more"],
		//"PREVIEW_PICTURE" => $_FILES['cover']
	);

	if($PRODUCT_ID = $el->Add($arLoadProductArray))
	{
		$arr['id'] = $PRODUCT_ID;
		$arr['date'] = date('d.m.Y');
		$arr['pic'] = '';
		$arr['txt'] = $text;
		$arr['success'] = 'ok';

	}
	else
	{
		$arr['er'] = 'somthing wrong';
	}
	
	echo json_encode($arr);

}
/***
<h4>15 октября 2016</h4>
***/
?>