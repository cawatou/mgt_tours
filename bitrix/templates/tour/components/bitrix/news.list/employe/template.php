<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? $k=0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<? if($k==0||$k%3==0){?><div class="row work-box"><?}?><? $k++; ?>

				<div class="col-md-4">
				<? //var_dump($arItem)?>
					<div class="work-usr">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" />
						<h3><?echo $arItem["NAME"]?></h3>
						<span><?=$arItem['PROPERTIES']['POST']['VALUE']?></span>
						
						<?if($arItem['PROPERTIES']['winner']['VALUE_XML_ID']=="5e8334d1984dd9c9791ad47abb05476f"){?>
						<div class="grant">Сотрудник месяца</div>
						<?}else{?>
						<div class=""></div>
						<?}?>
						<a href="#" data-id="<?=$arItem['ID']?>">Оценить работу сотрудника</a>
						<div class="work-overload">
							<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">подробнее о сотруднике</a>
						</div>
					</div>
				</div>
	
	<?if($k%3==0){?></div><?}?>
	
<?endforeach;?>
<?if(count($arResult["ITEMS"])%3!=0){?></div><?}?>





