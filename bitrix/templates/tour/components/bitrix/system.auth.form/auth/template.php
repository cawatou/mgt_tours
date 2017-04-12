<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (strlen($_POST['ajax_key']) && $_POST['ajax_key']==md5('ajax_'.LICENSE_KEY)) {
   $APPLICATION->RestartBuffer();
   if (!defined('PUBLIC_AJAX_MODE')) {
      define('PUBLIC_AJAX_MODE', true);
   }
   header('Content-type: application/json');
   if ($arResult['ERROR']) {
      echo json_encode(array(
         'type' => 'error',
         'message' => strip_tags($arResult['ERROR_MESSAGE']['MESSAGE']),
      ));
   } else {
      echo json_encode(array('type' => 'ok'));
   }
   require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
   die();
}
?>
<?if ($arResult["FORM_TYPE"] == "login"):?>

<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Вход в личный кабинет</h4>
      </div>
	  <form method="post" id="loginForm" action="<?=$arResult["AUTH_URL"]?>">
	  <?
	if (strlen($arResult["BACKURL"]) > 0)
	{
	?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?
	}
	?>
	<?
	foreach ($arResult["POST"] as $key => $value)
	{
	?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?
	}
	?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
      <div class="modal-body">
        <div class="form-group"><?  // ?>
		
			<input type="text" class="form-control  "  name="USER_LOGIN"  value="<?=$arResult["USER_LOGIN"]?>"  placeholder="Логин"><? 
			//
			?>
        </div>
		 <div class="form-group">
			<input  type="password" name="USER_PASSWORD" class="form-control" placeholder="Пароль">
		 </div>
		
		<div class="row">
			<div class="col-sm-6 col-xs-6 " style="    text-align: center;">
				<button type="submit" class="btnformmodalred">Войти</button>
			</div>
			<div class="col-sm-6 col-xs-6" style="    text-align: center;">
				<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="lostpwd">Забыли пароль?</a>
			</div>
		 </div>
      </div>
      <div class="modal-footer" style="text-align:center">
       
        <button type="button"  class="regbtn btnformmodalwhite">Регистрация</button>
      </div>
	  </form>


<?else:?>

<form action="<?=$arResult["AUTH_URL"]?>">

<?=$arResult["USER_NAME"]?> [<a href="/lk/" class="profile-link" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_LOGIN"]?></a>]

<?foreach ($arResult["GET"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="logout" value="yes" />
	<!--input type="image" src="<?=$templateFolder?>/images/login.gif" alt="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>"-->
</form>
<?endif?>