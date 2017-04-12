<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("iblock");
// Находим id города (турвизора) по id битрикса
if(isset($_REQUEST['city_bid'])){
	$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 16, 'ID' => $_REQUEST['city_bid']), false, array('UF_CITYID'));
	while ($arSection = $rsSections->Fetch()) {
		$city_id = $arSection['UF_CITYID'];
	}
}else{
	$city_id = $_REQUEST['city_id'];
}

$arSelect = Array("ID", "NAME", "PROPERTY_siblings", "PROPERTY_city_id");
$arFilter = Array("IBLOCK_ID" => 24, "ACTIVE" => "Y", "PROPERTY_city_id" => $city_id);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 9999), $arSelect);
while ($ob = $res->GetNextElement()) {
	$city = $ob->GetFields();
	$citys[] = $city;
	$siblings = $city['PROPERTY_SIBLINGS_VALUE'];
}

foreach($siblings as $sibling){
	$db_props = CIBlockElement::GetProperty(24, $sibling, Array(), Array("CODE"=>"city_id"));
	if($ar_props = $db_props->Fetch()){
		$tour_cityid[] = $ar_props['VALUE'];
	}
}

foreach($tour_cityid as $cityid){
	$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 20, "UF_DEPARTURE" => $cityid));
	while ($arSection = $rsSections->Fetch()) {
		$sections[$arSection['ID']] = $arSection;
		$arSelect = Array("ID", "NAME", "PROPERTY_DATEFROM", "PROPERTY_COUNTRY", "PROPERTY_DEPARTURE", "PROPERTY_CURORT", "PROPERTY_DAYCOUNT", "PROPERTY_MIN_PRICE");
		$arFilter = Array("IBLOCK_ID" => 20, "SECTION_ID" => $arSection['ID'], "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 9999), $arSelect);
		while ($ob = $res->GetNextElement()) {
			$tour = $ob->GetFields();
			$tours[$arSection['ID']][] = $tour;
		}
	}
}
if($_REQUEST['dev']) echo "<pre>fdasfasfa".print_r($sections, 1)."</pre>";
//echo "<pre>".print_r($tours, 1)."</pre>";
//exit();
$i=0;
if(count($tours) > 0):?>
<div class="container hotturblock" >
	<div class="row r25">
		<?foreach ($tours as $k => $items):
			$i++;?>
			<div class="col-md-3 i<?=$i?>" >
				<div class="hotblocks">
					<div class="row">
						<div class="col-md-6 ">
							<span class="tur_country"><?=$items[0]['PROPERTY_COUNTRY_VALUE']?></span>
							<span class="tur_city"><?=$items[0]['PROPERTY_CURORT_VALUE']?></span>
						</div>
						<div class="col-md-6 ">
							<span class="tur_discount">-25%</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<span class="tur_price"><?=$items[0]['PROPERTY_MIN_PRICE_VALUE']?> Р</span>
							<span class="tur_start">из г.<?=$items[0]['PROPERTY_DEPARTURE_VALUE']?></span>

							<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: <?=$items[0]['PROPERTY_DATEFROM_VALUE']?></span>
							<span class="tur_night"><i class="calendar1"></i> Количество ночей: <?=$items[0]['PROPERTY_DAYCOUNT_VALUE']?></span>
							<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: <?=date('d.m.Y');?></span>
						</div>
					</div>
				</div>
				<div class="hotdeals" data-url="/content/tours/?id=<?=$k?>">
					<?foreach($items as $tour):?>
						<div>
							<span><?=$tour['PROPERTY_DATEFROM_VALUE']?></span>
							<span><?=$tour['PROPERTY_DAYCOUNT_VALUE']?> дней</span>
							<span><?=$tour['PROPERTY_MIN_PRICE_VALUE']?> Р</span>
						</div>
					<?endforeach?>
				</div>
			</div>
			<?if($i === 4){
				$i = 0;
				break;
			} ?>
		<?endforeach?>
	</div>
	<?if(count($tours) > 4):?>
		<div class="row r25">
			<?foreach($tours as $k =>$items):
				if($i < 4) {
					$i++;
					continue;
				}?>
				<div class="col-md-3 " >
				<div class="hotblocks">
					<div class="row">
						<div class="col-md-6 ">
							<span class="tur_country"><?=$items[0]['PROPERTY_COUNTRY_VALUE']?></span>
							<span class="tur_city"><?=$items[0]['PROPERTY_CURORT_VALUE']?></span>
						</div>
						<div class="col-md-6 ">
							<span class="tur_discount">-25%</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<span class="tur_price"><?=$items[0]['PROPERTY_MIN_PRICE_VALUE']?> Р</span>
							<span class="tur_start">из г.<?=$items[0]['PROPERTY_DEPARTURE_VALUE']?></span>

							<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: <?=$items[0]['PROPERTY_DATEFROM_VALUE']?></span>
							<span class="tur_night"><i class="calendar1"></i> Количество ночей: <?=$items[0]['PROPERTY_DAYCOUNT_VALUE']?></span>
							<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: <?=date('d.m.Y');?></span>
						</div>
					</div>
				</div>
				<div class="hotdeals" data-url="/content/tours/?id=<?=$k?>">
					<?foreach($items as $tour):?>
					<div>
						<span><?=$tour['PROPERTY_DATEFROM_VALUE']?></span>
						<span><?=$tour['PROPERTY_DAYCOUNT_VALUE']?> дней</span>
						<span><?=$tour['PROPERTY_MIN_PRICE_VALUE']?> Р</span>
					</div>
					<?endforeach?>
				</div>
			</div>
				<?if($i == 8) break;?>
			<?endforeach?>
		</div>
	<?endif?>
</div>
<div class="container hotturblock-mobile" >
	<div class="hot-carusel owl-carousel">
		<?foreach ($tours as $k => $items):?>
			<div class="item">
				<div class="wraps " >
					<div class="hotblocks">
						<div class="row">
							<div class="col-xs-6 ">
								<span class="tur_country"><?=$items[0]['PROPERTY_COUNTRY_VALUE']?></span>
								<span class="tur_city"><?=$items[0]['PROPERTY_CURORT_VALUE']?></span>
							</div>
							<div class="col-xs-6 ">
								<span class="tur_discount">-25%</span>
								<span class="tur_price"><?=$items[0]['PROPERTY_MIN_PRICE_VALUE']?> Р</span>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: <?=$items[0]['PROPERTY_DATEFROM_VALUE']?></span>
								<span class="tur_night"><i class="calendar1"></i> Количество ночей: <?=$items[0]['PROPERTY_DAYCOUNT_VALUE']?></span>
								<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: <?=date('d.m.Y');?></span>
							</div>
						</div>
					</div>
					<div class="hotdeals" data-url="/content/tours/?id=<?=$k?>">
						<?foreach($items as $tour):?>
							<div>
								<span><?=$tour['PROPERTY_DATEFROM_VALUE']?></span>
								<span><?=$tour['PROPERTY_DAYCOUNT_VALUE']?></span>
								<span><?=$tour['PROPERTY_MIN_PRICE_VALUE']?> Р</span>
							</div>
						<?endforeach?>
					</div>
				</div>		
			</div>
		<?endforeach?>
	</div>
</div>
<?else: return 0;
endif;?>