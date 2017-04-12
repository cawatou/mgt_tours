<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $k=0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	

	
		<div class="item">
			<div class="art-box">
				<div class="pic">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="100%" alt="" />
				</div>
				<div class="contents">
					<h3><?echo $arItem["NAME"]?></h3>
					<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
					<p><?echo $arItem["PREVIEW_TEXT"];?></p>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">читать далее</a>
				</div>
			</div>
		</div>


	
	
<?endforeach;?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>




