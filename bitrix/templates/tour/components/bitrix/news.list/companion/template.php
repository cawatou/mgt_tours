<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

	//var_dump($arResult["ITEMS"]);

?>



<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class=" item" >
		<div class="companions">
			<div class="imgbox" style="background-image:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);background-size:cover;"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"></div>
		<i class="fa fa-eye redish"></i>
		<span><?=$arItem["SHOW_COUNTER"]?> просмотров</span>
		
		<h3><?=$arItem["PROPERTIES"]["comp_name"]["VALUE"];?></h3>
		
		<p><?=$arItem["PREVIEW_TEXT"];?></p>
		</div>
	</div>
<?endforeach;?>



