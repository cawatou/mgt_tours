<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*
echo "<pre>";
var_dump($arResult);
echo "</pre>";*/
?>
<div class="blockbgr franchize">
	<h2><?=$arResult['NAME']?></h2>
	<div class="img"><?=CFile::ShowImage($arResult['SECTION']['PATH'][0]['PICTURE'], 0, 0, "", "", false)?></div>
	<h3><?=$arResult['SECTION']['PATH'][0]['NAME']?></h3>
	<p><?=$arResult['SECTION']['PATH'][0]['DESCRIPTION']?></p>
	<hr>
	<h3 class="preim">Преимущества</h3>
	<div  class="row franchise-carusel  owl-carousel" >
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<div class="col-md-4  col-xs-12" >
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
				<h4><?=$arItem["NAME"]?></h4>
				<p><?=$arItem["PREVIEW_TEXT"]?></p>
			</div>
		<?endforeach;?>
	</div>
	<a href="/content/franchize/">Перейти на страницу франшизы</a>
</div>






