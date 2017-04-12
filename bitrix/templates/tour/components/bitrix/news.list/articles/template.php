<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1 >Статьи</h1>
	<div  class="row art-carusel  owl-carousel" >
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="col-md-6 col-xs-12 item" >
			<div class="article">
				
				<h3><?echo $arItem["NAME"]?></h3>
				<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
				
				<p><?echo $arItem["PREVIEW_TEXT"];?></p>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">читать далее</a>
			</div>
		</div>
		<?endforeach;?>
	</div>
	<a href="/content/articles/" class="allarticle">все статьи</a>