<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="item">
		<div class="row">
			<div class="col-md-6">
				<p><?=$arItem["PREVIEW_TEXT"]?></p>
				<div><b><?=$arItem["NAME"]?></b><span><?=$arItem["PROPERTIES"]["POST"]["VALUE"]?></span></div>
			</div>
			<div class="col-md-6">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" />
			</div>
		</div>
	</div>
	
<?endforeach;?>






