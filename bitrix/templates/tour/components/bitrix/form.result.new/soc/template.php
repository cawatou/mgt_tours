<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>

<?if ($arResult["isFormErrors"] == "Y"):?><p class="bg-danger"><?=$arResult["FORM_ERRORS_TEXT"];?></p><?endif;?>

<?if ($arResult["isFormNote"] != "Y")
{
	?>
	<?=$arResult["FORM_HEADER"]?>

	<?
	if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
	{
		?>
		<?
/***********************************************************************************
					form header
					***********************************************************************************/
					if ($arResult["isFormTitle"])
					{
						?>
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><!-- <?=$arResult["FORM_TITLE"]?> -->Подписка на соц сеть</h4>
						</div>
						<?
} //endif ;

if ($arResult["isFormImage"] == "Y")
{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>



	<?
} // endif
?>

<?
/***********************************************************************************
						form questions
						***********************************************************************************/
						?>
						<div class="modal-body">
	<div class="form-group">
		<input type="hidden" name="form_text_74" value="" >
		<input type="hidden" name="form_dropdown_social" value="" >
		<input type="text" class="form-control  phone-number-for-mask" placeholder="Ваш телефон" name="form_text_73" value="" size="0">
	</div>
	
	<?
	if($arResult["isUseCaptcha"] == "Y")
	{
		?>
		<div class="row">
			<div class="col-sm-5">
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
			</div>
			<div class="col-sm-7">
				<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
				<input type="text" class="form-control" name="captcha_word"  placeholder="<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?>">
			</div>
		</div>


		<?
} // isUseCaptcha
?>
</div>
<div class="modal-footer" style="text-align:left">
	<button type="submit" class=" btnformmodalred">Отправить</button>
</div>


<p>
	<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>