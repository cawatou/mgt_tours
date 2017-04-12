<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); 
?>
<?
if($_REQUEST['id']==7) $tpl ="vote";else  $tpl ="question";
$APPLICATION->IncludeComponent("bitrix:form.result.new",$tpl,Array(
        
        "SEF_MODE" => "N", 
        "WEB_FORM_ID" => $_REQUEST['id'], 
        "EDIT_URL" => "edit.php",
        "CHAIN_ITEM_TEXT" => "", 
        "CHAIN_ITEM_LINK" => "", 
        "IGNORE_CUSTOM_TEMPLATE" => "N", 
       
        "SUCCESS_URL" => "", 
		"COMPONENT_TEMPLATE" => $tpl,
        
        "LIST_URL" => "result.php", 
        "USE_EXTENDED_ERRORS" => "N", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "0", 
       
        "VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID")
        
    )
);?>