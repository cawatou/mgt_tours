<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="row">


<?/*
 echo "<pre>";
var_dump($arResult["ITEMS"]);
	echo "</pre>";*/
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	
	<?//echo $arItem["PROPERTIES"]["CITY"]["VALUE"]?>
	
	<div class="col-md-4 col-xs-12">
		<div class="job-box">
			<h3><?echo $arItem["NAME"]?></h3>
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>
			<div>
				<b>Уровень зарплаты</b><span><?echo $arItem["PROPERTIES"]["MONEY"]["VALUE"]?> Р</span>
			</div>
			<div class="job-full-text"><h3><?echo $arItem["NAME"]?></h3><?echo $arItem["DETAIL_TEXT"];?></div>
			<a href="#" class="iwant otklikjob" data-id="<?echo $arItem["ID"]?>">Откликнуться на вакансию</a>
			<a href="#" class="more" data-id="<?echo $arItem["ID"]?>">Подробнее</a>
		</div>
	</div>
	
<?endforeach;?>
</div>
