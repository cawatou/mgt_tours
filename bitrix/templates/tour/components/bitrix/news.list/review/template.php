<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class=" item" >
		<div class="review">
			<div class="imgbox" style="background-image:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);background-size:cover;"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
			<h3><?echo $arItem["DISPLAY_PROPERTIES"]["NAME"]["VALUE"]?></h3>
			<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<i class="fa  fa-quote-left redish"></i>
			<p><?=$arItem["PREVIEW_TEXT"]?></p>
		</div>
	</div>
	
<?endforeach;?>

