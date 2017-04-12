<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $k=0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<? if($k==0||$k%4==0){?><div class="row <?if($k!=0){?>nextr<?}?>"><?}?><? $k++; ?>

		<div class="col-md-3">
			<div class="item" style="background:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)">
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
			</div>
		</div>

	<?if($k%4==0){?></div><?}?>
	
<?endforeach;?>

<?
if($k%4!=0) echo "</div>";
?>