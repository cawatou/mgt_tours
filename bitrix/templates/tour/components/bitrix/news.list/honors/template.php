<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?// var_dump($arItem["PROPERTIES"]["REAL_PICTURE"]) ?>
	<div class="pic"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>" alt="" /><div class="over fa fa-search fa-5x"></div></div>
	
<?endforeach;?>




