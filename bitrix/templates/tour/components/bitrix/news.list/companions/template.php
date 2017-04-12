<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $k=0; ?>
<div id="results">
<?foreach($arResult["ITEMS"] as $arItem):?>



<? if($k==0||$k%3==0){?><div class="row"><?}?><? $k++; ?>
		<div class="col-md-4 col-xs-12">
			<div class="find-box">
				<div style="text-align:center;">
					<p><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="ava"></p>
					<p><i class="fa fa-eye"></i></p>
					<p><span class="views">  просмотров</span></p>
				</div>
				<ul class="oglavl">
					<li>
						<span class="text">Имя</span>
						<span class="page"><?=$arItem["NAME"]?></span>
					</li>
					<li>
						<span class="text">Телефон</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_phone"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Почта</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_mail"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Пол</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_sex"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Город вылета</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_city"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Ближайшие города</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_citys"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Интересующийся пол</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_who"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Возраст</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_age"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Страна</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["COMCOUNTRY"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Дата вылета</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_flydate"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Дней отдыха</span>
						<span class="page"><?=$arItem["DISPLAY_PROPERTIES"]["com_day"]["VALUE"]?> дней</span>
					</li>
				</ul>
				<h3>Информация о себе:</h3>
				<p><?=substr($arItem["PREVIEW_TEXT"],0,200)?></p>
				
				<div class="row">
					<div class="col-md-6 col-xs-4">
						<p class="social">
							<?if(count($arItem["DISPLAY_PROPERTIES"]["com_links"]["VALUE"])!=0){
								foreach($arItem["DISPLAY_PROPERTIES"]["com_links"]["VALUE"] as $l){
									
									if(substr_count($l,"vk.com")) echo '<a class="fa fa-vk " href="'.$l.'"></a>';
									if(substr_count($l,"fb.com")) echo '<a class="fa fa-facebook " href="'.$l.'"></a>';
									
								}
							}?>
							
						</p>
					</div>
					<div class="col-md-6 col-xs-8">
						<p class="actualy">
							<b>Поиск актуален до:<br><span ><?=$arItem["DISPLAY_PROPERTIES"]["com_actualy"]["VALUE"]?></span></b>
						</p>
					</div>
				</div>
			</div>
		</div>
<?if($k%3==0){?></div><?}?>


	
<?endforeach;?>

</div>
<?if(count($arResult["ITEMS"])%3!=0){?></div><?}?>

<div class="row">
		<div class="col-md-12 col-xs-12 buttonblock">
			<a href="#" class="box" data-toggle="modal" data-target="#addcompany" >заполнить анкету</a>
		</div>
	</div>
	
<?=$arResult["NAV_STRING"]?>

