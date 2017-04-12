<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("iblock");
$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 20, "ID" => $_REQUEST['id']));
while ($arSection = $rsSections->Fetch()) {
	$sections[$arSection['ID']] = $arSection;

	//============= Собираем массив туров ==============
	$arSelect = Array("ID", "NAME", "PROPERTY_DATEFROM", "PROPERTY_COUNTRY","PROPERTY_DISCOUNT", "PROPERTY_DEPARTURE", "PROPERTY_CURORT", "PROPERTY_DAYCOUNT", "PROPERTY_MIN_PRICE");
	$arFilter = Array("IBLOCK_ID" => 20, "SECTION_ID" => $arSection['ID'], "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
	while ($ob = $res->GetNextElement()) {
		$tour = $ob->GetFields();

		//============= Собираем массив отелей ==============
		$arSelect = Array("ID", "NAME", "PROPERTY_TOURIDBX", "PROPERTY_hotelstars", "PROPERTY_nights", "PROPERTY_price", "PROPERTY_meal", "PROPERTY_operatorname", "PROPERTY_img", "PROPERTY_tourid");
		$arFilter = Array("IBLOCK_ID"=>23, "PROPERTY_TOURIDBX"=>$tour['ID']);
		$result = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($obj = $result->GetNextElement()) {
			$hotel = $obj->GetFields();
			$tour['hotels'][] = $hotel;
		}
		$tours[] = $tour;
	}
}
GLOBAL $meals;
if(count($tours) < 1)  header('Location: /');
if($_REQUEST['dev']) echo "<pre>".print_r($tours, 1)."</pre>";
?>

<div class="row">
	<div class="col-md-12 col-xs-12 topturinfo">
		<h1 class="icon_tour"><?=$tours[0]['PROPERTY_COUNTRY_VALUE']?></h1>
		<p><?=$tours[0]['PROPERTY_CURORT_VALUE']?></p>
		<span>от <?=$tours[0]['PROPERTY_MIN_PRICE_VALUE']?> Р </span>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<h2 class="icon_time">Выберите дату вылета</h2>
	</div>
</div>
<div class="row tour-menu">
	<div class="col-md-6 col-xs-12 pad0" >
		<div class="row flyline right">
			<?for($i=0; $i <= 3; $i++):?>
				<?if(isset($tours[$i]['ID'])):?>
					<div class="col-md-3 col-xs-3 ">
						<p class="fly_date" data-id="<?=$tours[$i]['ID']?>">
							<span><?=$tours[$i]['PROPERTY_DATEFROM_VALUE']?></span>
							<span>на <?=$tours[$i]['PROPERTY_DAYCOUNT_VALUE']?> дней</span>
							<span data-placement="bottom" data-toggle="tooltip" title="до 30 дней">Срок на визу</span>
						</p>
					</div>
				<?endif?>
			<?endfor?>
		</div>
	</div>
	<div class="col-md-6 col-xs-12 pad0" >
		<div class="row flyline left">
			<?for($i=4; $i <= 7; $i++):?>
				<?if(isset($tours[$i]['ID'])):?>
					<div class="col-md-3 col-xs-3 ">
						<p class="fly_date" data-id="<?=$tours[$i]['ID']?>">
							<span><?=$tours[$i]['PROPERTY_DATEFROM_VALUE']?></span>
							<span>на <?=$tours[$i]['PROPERTY_DAYCOUNT_VALUE']?> дней</span>
							<span data-placement="bottom" data-toggle="tooltip" title="до 30 дней">Срок на визу</span>
						</p>
					</div>
				<?endif?>
			<?endfor?>
		</div>
	</div>
</div>
<div class="row hotels">
	<div class="row">
		<div class="col-md-6 col-xs-6">
			<h3 class="">Отели</h2>
		</div>
		<div class="col-md-6 col-xs-6">
			<div class="hotlist"><span class="fa fa-list-ul"></span></div>
			<div class="hotthumb active"><span class="thumb"></span></div>
		</div>
	</div>
	<div class="tabouterwrap">
		<?foreach($tours as $k => $tour):?>
			<div data-id="<?=$tour['ID']?>" class="tabwrap">
				<div class="hotel-carusel">
					<?foreach($tour['hotels'] as $hotel):?>
						<div class="item">
							<div class="hotel" style="background: url(<?='http://'.$hotel['PROPERTY_IMG_VALUE']?>) no-repeat center center; background-size: cover;">
								<h4><?=$hotel['NAME']?></h4>

								<div class="hotel_star">
									<?foreach($hotel['PROPERTY_HOTELSTARS_VALUE'] as $star):?>
										<span class="fa fa-star yellow"></span>
									<?endforeach?>
								</div>
<?
										$proc=round(100 - (($tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/$tours[$k][0]['PROPERTY_PRICEOLD_VALUE'])*100));
										if($proc>2){ ?><span class="hotel_discount">-<?=$proc ?> %</span><?}?>
										
								
								<span class="hotel_price"><?if(!empty($tour['PROPERTY_DISCOUNT_VALUE'])){
							echo ($hotel['PROPERTY_PRICE_VALUE']/2)-((($hotel['PROPERTY_PRICE_VALUE']/2)/100)*$tour['PROPERTY_DISCOUNT_VALUE']);
						}
						else
						 echo $hotel['PROPERTY_PRICE_VALUE']/2;
						?> Р</span>

								<p class="hotel_eat"><?if(isset($meals[$hotel['PROPERTY_MEAL_VALUE']])) $meal = $meals[$hotel['PROPERTY_MEAL_VALUE']]["russian"]; else $meal = $hotel['PROPERTY_MEAL_VALUE'];?> <?=$meal?></p>

								<p><img src="/bitrix/templates/tour/images/paladdin/calendar.png" alt=""> <?=$hotel['PROPERTY_NIGHTS_VALUE']?> ночей<br><?if(CSite::InGroup(array(1,10))){?><span>Турагентство: <span><?=$hotel['PROPERTY_OPERATORNAME_VALUE']?></span></span><?}?></p>

								<p class="links" data-tourvid="<?=$hotel['PROPERTY_TOURID_VALUE']?>">
									<a href="#" class="payonline">оплатить онлайн</a>
									<a href="#" class="payoffice">оплатить в офисе</a>
								</p>
							</div>
						</div>
					<?endforeach?>
				</div>

				<div class="hotel-list">
					<?foreach($tour['hotels'] as $hotel):?>
						<div class="hotel-line">
							<div class="img" style="background: url(<?='http://'.$hotel['PROPERTY_IMG_VALUE']?>) no-repeat center center;"></div>
							<div class="hotel-name">
								<h4><?=$hotel['NAME']?></h4>
								<span><?=$hotel['PROPERTY_MEAL_VALUE']?></span>
							</div>
							<div class="hotel_star">
								<?foreach($hotel['PROPERTY_HOTELSTARS_VALUE'] as $star):?>
									<span class="fa fa-star yellow"></span>
								<?endforeach?>
							</div>
							<p><img src="/bitrix/templates/tour/images/paladdin/calendar.png" alt=""> <?=$hotel['PROPERTY_NIGHTS_VALUE']?> ночей<br><?if(CSite::InGroup(array(1,10))){?><span>Турагентство: <span><?=$hotel['PROPERTY_OPERATORNAME_VALUE']?></span></span><?}?></p>

							<div class="hotel-price">
								<span><?if(!empty($tour['PROPERTY_DISCOUNT_VALUE'])){
							echo ($hotel['PROPERTY_PRICE_VALUE']/2)-((($hotel['PROPERTY_PRICE_VALUE']/2)/100)*$tour['PROPERTY_DISCOUNT_VALUE']);
						}
						else
						 echo $hotel['PROPERTY_PRICE_VALUE']/2;
						?> Р</span>
							</div>
							<div class="hotel-links" data-tourvid="<?=$hotel['PROPERTY_TOURID_VALUE']?>">
								<a href="#" class="payonline">оплатить онлайн</a>
								<a href="#" class="payoffice">оплатить в офисе</a>
							</div>
						</div>
					<?endforeach?>
				</div>
			</div>
		<?endforeach?>
	</div>
</div>
</div>

<div style="margin-bottom: 76px;" class="container">
	<div class="row tour-menu tour-menu-bottom">
		<div class="col-md-6 col-xs-12 pad0" >
			<div class="row  fly-bgr one">
				<div class="col-md-3 col-xs-3 fly-from">
					<span>Туда</span>
				</div>
				<div class="col-md-9 col-xs-9 fly-info">
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<div class="fly-info-block">
								<span>Вылет</span>
								<span>16.11.2016 в 18:00</span>
								<span>из Москвы</span>

							</div>
						</div>
						<div class="col-md-6 col-xs-6">
							<div class="fly-info-block">
								<span>Прилет</span>
								<span>17.11.2016 в 18:00</span>
								<span>из Алматы</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12 pad0" >
			<div class="row fly-bgr two">
				<div class="col-md-3 col-xs-3 fly-to">
					<span>Обратно</span>
				</div>
				<div class="col-md-9 col-xs-9 fly-info">
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<div class="fly-info-block">
								<span>Вылет</span>
								<span>16.11.2016 в 18:00</span>
								<span>из Москвы</span>
							</div>
						</div>
						<div class="col-md-6 col-xs-6">
							<div class="fly-info-block">
								<span>Прилет</span>
								<span>17.11.2016 в 18:00</span>
								<span>из Алматы</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>