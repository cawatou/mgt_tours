<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $k=0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<? if($k==0||$k%3==0){?><div class="row art-row"><?}?><? $k++; ?>

	
		<div class="col-md-4 col-xs-12 ">
			<div class="art-box">
				<div class="pic" >
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="100%" alt="" border=0 />
					</a>
				</div>
				<div class="contents">
					<h3><?echo $arItem["NAME"]?></h3>
					<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
					<p><?echo $arItem["PREVIEW_TEXT"];?></p>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">читать далее</a>
				</div>
			</div>
		</div>


	<?if($k%3==0){?></div><?}?>
	
<?endforeach;?>
<?if(count($arResult["ITEMS"])%3!=0){?></div><?}?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>




