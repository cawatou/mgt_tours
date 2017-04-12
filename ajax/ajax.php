<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();
if( $_REQUEST['action']=='email') {
	if(!empty($_REQUEST['email'])){
		// ID веб-формы
		$FORM_ID = 4;
		CModule::IncludeModule("form");
		
		// массив значений ответов
		$arValues = array (

			"form_text_33"                =>  $_REQUEST['email']
		);

		// создадим новый результат
		if ($RESULT_ID = CFormResult::Add($FORM_ID, $arValues))
		{
			echo "E-mail добавлен в список рассылки";
		}
		else
		{
			global $strError;
			echo $strError;
		}
	}
}
?>