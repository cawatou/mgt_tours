<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="row footermenu" >
	<div class="col-md-6  col-xs-12"  >
		<ul>
<?if (!empty($arResult)):?>
<?
$k=0;
$f=ceil(count($arResult)/2);
foreach($arResult as $arItem):?>
	<?if ($arItem["PERMISSION"] > "D"):?>
		<?if ($arItem["SELECTED"]):?>
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>
		<?$k++;?>
	<?endif?>
	
	<?
	if($k%$f==0) {
		?></ul>
	</div>
	<div class="col-md-6  col-xs-12 trick" >
		<ul>
		<?
	}
	?>
<?endforeach?>

<?endif?>


		</ul>
	</div>
</div>