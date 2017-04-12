<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="col-md-3">
					<div class="im"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">&nbsp;</div>
					<span><?echo $arItem["NAME"]?></span>
					<p><?=$arItem["PROPERTIES"]["descr_advant"]["VALUE"]?></p>
				</div>
	
		


	
<?endforeach;?>




