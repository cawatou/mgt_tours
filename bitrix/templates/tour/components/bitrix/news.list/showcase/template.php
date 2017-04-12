<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("iblock");
$rsSections = CIBlockSection::GetList(array("UF_MIN_PRICE" => "ASC"), array('IBLOCK_ID' => 20, "UF_DEPARTURE" => $_REQUEST['city_id']));
while ($arSection = $rsSections->Fetch()) {
	$sections[$arSection['ID']] = $arSection;
	$arSelect = Array("ID", "NAME", "PROPERTY_DATEFROM", "PROPERTY_COUNTRY", "PROPERTY_DISCOUNT", "PROPERTY_DEPARTURE", "PROPERTY_CURORT", "PROPERTY_DAYCOUNT", "PROPERTY_MIN_PRICE");
	$arFilter = Array("IBLOCK_ID" => 20, "SECTION_ID" => $arSection['ID'], "ACTIVE" => "Y");
	$res = CIBlockElement::GetList(Array("PROPERTY_MIN_PRICE" => "ASC"), $arFilter, false, Array("nPageSize" => 50), $arSelect);
	while ($ob = $res->GetNextElement()) {
		$tour = $ob->GetFields();
		$tours[$arSection['ID']][] = $tour;
	}
}
?>
<?/* ======================= Загрузка первых 4 ех туров в витрину ===============================================*/?>
<?if(count($sections) > 0 && isset($_REQUEST['showcase'])):?>
	<?$i=0;?>
	<div class="owl-carousel gridview">
		<?foreach ($sections as $k => $section): ?>
			<?$i++?>
			<div class="item ">
				<div class="hotblocks"  <? if ($section["PICTURE"] != NULL) { ?>style="background-image: url(<?= CFile::GetPath($section["PICTURE"]) ?>) !important;" <?} ?>>
					<div class="row">
						<div class="col-md-9 col-sm-6 col-xs-6">
							<span class="tur_country"><?=$tours[$k][0]['PROPERTY_COUNTRY_VALUE'] ?></span>
							<span class="tur_city"><?=$tours[$k][0]['PROPERTY_CURORT_VALUE'] ?></span>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-6">
							<?
							$proc=round(100 - (($tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/$tours[$k][0]['PROPERTY_PRICEOLD_VALUE'])*100));
							if($proc>2){ ?><span class="tur_discount">-<?=$proc ?> %</span><?}?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<span class="tur_price"><?
								echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/2;
								?> Р</span>
							<span class="tur_date"><i
									class="fa fa-plane redish"></i> Дата вылета: <?=date('d.m',strtotime($tours[$k][0]['PROPERTY_DATEFROM_VALUE'])) ?></span>
							<span class="tur_night"><i
									class="calendar1"></i> Количество ночей: <?=$tours[$k][0]['PROPERTY_DAYCOUNT_VALUE'] ?></span>
							<span class="tur_update"><i
									class="fa fa-refresh redish"></i> Обновлено: <?=date('h:i'); ?></span>
						</div>
					</div>
				</div>
				<div class="hotdeals" data-url = "/content/tours/?id=<?=$k;?>">
					<?foreach ($tours[$k] as $tour):?>
						<div>
							<span><?= $tour['PROPERTY_DATEFROM_VALUE'] ?></span>
							<span><?= $tour['PROPERTY_DAYCOUNT_VALUE'] ?> дней</span>
							<span><?= $tour['PROPERTY_MIN_PRICE_VALUE']/2 ?> Р</span>
						</div>
					<?endforeach?>
				</div>
			</div>
			<?if($i == 4) {
				$i = 0;
				break;
			}?>
		<? endforeach ?>
	</div>

	<div class="listview">
		<? foreach ($sections as $k => $section): ?>
			<?$i++?>
			<div class="deal">
				<div class="hotlistview">
					<div class="row">
						<div class="col-md-2 ">
							<div class="pic"><img src="<?= CFile::GetPath($t["PREVIEW_PICTURE"]) ?>"
												  alt=""/></div>
						</div>
						<div class="hotlisted">
							<div class="col-md-2 ">
								<?= $tours[$k][0]['PROPERTY_COUNTRY_VALUE'] ?>,
								<b><?= $tours[$k][0]['PROPERTY_CURORT_VALUE'] ?></b>
							</div>
							<div class="col-md-2 ">
								<i class="fa fa-plane redish"></i><b> Дата
									вылета: <?= date('d.m',$tours[$k][0]['PROPERTY_DATEFROM_VALUE']) ?></b>
							</div>
							<div class="col-md-2 ">
								<i class="calendar2"></i><b> Количество
									ночей: <?= $tours[$k][0]['PROPERTY_DAYCOUNT_VALUE'] ?></b>
							</div>
							<div class="col-md-2 hotrefresh ">
								<i class="fa fa-refresh redish"></i>
								Обновлено: <?= date('h:i'); ?>
							</div>
						</div>
						<div class="hotlistover">
							<div class="col-md-8 ">
								<? foreach ($tours[$k] as $tour): ?>
									<p>
										<b><?= $tour['PROPERTY_DATEFROM_VALUE'] ?></b>
										<?= $tour['PROPERTY_DAYCOUNT_VALUE'] ?> дней
										<i><?= $tour['PROPERTY_MIN_PRICE_VALUE'] ?> Р</i>
									</p>
								<? endforeach ?>
							</div>
						</div>

						<div class="col-md-2 hotprice">
										<span class="price"><?

											echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/2;
											?> Р</span>

							<?
							$proc=round(100 - (($tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/$tours[$k][0]['PROPERTY_PRICEOLD_VALUE'])*100));
							if($proc>2){ ?><span class="discount">-<?=$proc ?> %</span><?}?>
						</div>
					</div>
				</div>
			</div>
			<?if($i == 4) {
				$i = 0;
				break;
			}?>
		<? endforeach ?>
	</div>
<?endif?>


<?/* ======================= Загрузка остальных туров в витрину (в виде слайдера) ==============================*/?>
<?if(count($sections) > 4 && $_REQUEST['remaining_tours']):?>
	<section class="vertical-scrolling remaining_tours" style="background:url('<?= $arr[2]['src'] ?>') no-repeat center center;">
		<div class="onlyPc">
			<div class="slideTur s1">
				<h1 class="hottur"><?= $arr[2]['name'] ?> <?= $User_city['city'] ?></h1>
				<div class="container hotturblock">
					<div class="hot-carusel2 owl-carousel">
						<?$i=0;
						foreach ($sections as $k => $section):
							if($i < 4) {
								$i++;
								continue;
							}
							if($i % 2 == 0):?><div class="item s<?=$i?>"><?endif?>
							<div class="itmbl">
								<div class="hotblocks">
									<div class="row">
										<div class="col-md-6 ">
											<span class="tur_country"><?=$tours[$k][0]['PROPERTY_COUNTRY_VALUE']?></span>
											<span class="tur_city"><?=$tours[$k][0]['PROPERTY_CURORT_VALUE']?></span>
										</div>
										<div class="col-md-6 ">

											<?if($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'] != NULL) { ?><span
												class="tur_discount">-<?=$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']?>
												%</span>
											<? } ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
													<span class="tur_price"><?if(!empty($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'])){
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']-(($tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/100)*$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']);
														}
														else
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE'];
														?>	Р</span>
											<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: <?=FormatDateFromDB($tours[$k][0]['PROPERTY_DATEFROM_VALUE'], "DD.MM") ?></span>
											<span class="tur_night"><i class="calendar1"></i> Количество ночей: <?=$tours[$k][0]['PROPERTY_DAYCOUNT_VALUE'] ?></span>
											<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: <?= date('h:i'); ?></span>
										</div>
									</div>
								</div>
								<div class="hotdeals" data-url = "/content/tours/?id=<?=$k;?>">
									<?foreach ($tours[$k] as $tour):?>
										<div>
											<span><?= $tour['PROPERTY_DATEFROM_VALUE'] ?></span>
											<span><?= $tour['PROPERTY_DAYCOUNT_VALUE'] ?> дней</span>
											<span><?= $tour['PROPERTY_MIN_PRICE_VALUE'] ?> Р</span>
										</div>
									<?endforeach?>
								</div>
							</div>
							<?if( ($i - 1) % 2 == 0):?></div><?endif?>
							<?if ($i == 11) break;?>
							<?$i++?>
						<?endforeach?>
					</div>
				</div>
			</div>



			<?if(count($sections) > 8):?>
				<div class="slideTur s2">
					<h1 class="hottur">Горящие туры из моего города</h1>
					<div class="container hotturblock">
						<div class="hot-carusel2 owl-carousel">
							<?$i=0;
							foreach ($sections as $k => $section):
								if($i < 12) {
									$i++;
									continue;
								}if($i % 2 == 0):?><div class="item s<?=$i?>"><?endif?>
								<div class="itmbl">
									<div class="hotblocks">
										<div class="row">
											<div class="col-md-6 ">
												<span class="tur_country"><?=$tours[$k][0]['PROPERTY_COUNTRY_VALUE']?></span>
												<span class="tur_city"><?=$tours[$k][0]['PROPERTY_CURORT_VALUE']?></span>
											</div>
											<div class="col-md-6 ">

												<?if($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'] != NULL) { ?><span
													class="tur_discount">-<?=$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']?>
													%</span>
												<? } ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
													<span class="tur_price"><?if(!empty($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'])){
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']-(($tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/100)*$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']);
														}
														else
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE'];
														?>	Р</span>
												<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: <?=FormatDateFromDB($tours[$k][0]['PROPERTY_DATEFROM_VALUE'], "DD.MM") ?></span>
												<span class="tur_night"><i class="calendar1"></i> Количество ночей: <?=$tours[$k][0]['PROPERTY_DAYCOUNT_VALUE'] ?></span>
												<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: <?= date('h:i'); ?></span>
											</div>
										</div>
									</div>
									<div class="hotdeals" data-url = "/content/tours/?id=<?=$k;?>">
										<?foreach ($tours[$k] as $tour):?>
											<div>
												<span><?= $tour['PROPERTY_DATEFROM_VALUE'] ?></span>
												<span><?= $tour['PROPERTY_DAYCOUNT_VALUE'] ?> дней</span>
												<span><?= $tour['PROPERTY_MIN_PRICE_VALUE'] ?> Р</span>
											</div>
										<?endforeach?>
									</div>
								</div>
								<?if( ($i - 1) % 2 == 0):?></div><?endif?>
								<?if ($i == 15) break;?>
								<?$i++?>
							<?endforeach?>
						</div>
					</div>
				</div>
			<?endif?>


			<?if(count($sections) > 16):?>
				<div class="slideTur s3">
					<h1 class="hottur">Горящие туры из моего города</h1>
					<div class="container hotturblock">
						<div class="hot-carusel2 owl-carousel">
							<?$i=0;
							foreach ($sections as $k => $section):
								if($i < 16) {
									$i++;
									continue;
								}if($i % 2 == 0):?><div class="item s<?=$i?>"><?endif?>
								<div class="itmbl">
									<div class="hotblocks">
										<div class="row">
											<div class="col-md-6 ">
												<span class="tur_country"><?=$tours[$k][0]['PROPERTY_COUNTRY_VALUE']?></span>
												<span class="tur_city"><?=$tours[$k][0]['PROPERTY_CURORT_VALUE']?></span>
											</div>
											<div class="col-md-6 ">

												<?if($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'] != NULL) { ?><span
													class="tur_discount">-<?=$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']?>
													%</span>
												<? } ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
													<span class="tur_price"><?if(!empty($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'])){
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']-(($tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/100)*$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']);
														}
														else
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE'];
														?>	Р</span>
												<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: <?=FormatDateFromDB($tours[$k][0]['PROPERTY_DATEFROM_VALUE'], "DD.MM") ?></span>
												<span class="tur_night"><i class="calendar1"></i> Количество ночей: <?=$tours[$k][0]['PROPERTY_DAYCOUNT_VALUE'] ?></span>
												<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: <?= date('h:i'); ?></span>
											</div>
										</div>
									</div>
									<div class="hotdeals" data-url = "/content/tours/?id=<?=$k;?>">
										<?foreach ($tours[$k] as $tour):?>
											<div>
												<span><?= $tour['PROPERTY_DATEFROM_VALUE'] ?></span>
												<span><?= $tour['PROPERTY_DAYCOUNT_VALUE'] ?> дней</span>
												<span><?= $tour['PROPERTY_MIN_PRICE_VALUE'] ?> Р</span>
											</div>
										<?endforeach?>
									</div>
								</div>
								<?if( ($i - 1) % 2 == 0):?></div><?endif?>
								<?if ($i == 23) break;?>
								<?$i++?>
							<?endforeach?>
						</div>
					</div>
				</div>
			<?endif?>
			<?if(count($sections) > 24):?>
				<div class="slideTur s4">
					<h1 class="hottur">Горящие туры из моего города</h1>
					<div class="container hotturblock">
						<div class="hot-carusel2 owl-carousel">
							<?$i=0;
							foreach ($sections as $k => $section):
								if($i < 24) {
									$i++;
									continue;
								}if($i % 2 == 0):?><div class="item s<?=$i?>"><?endif?>
								<div class="itmbl">
									<div class="hotblocks">
										<div class="row">
											<div class="col-md-6 ">
												<span class="tur_country"><?=$tours[$k][0]['PROPERTY_COUNTRY_VALUE']?></span>
												<span class="tur_city"><?=$tours[$k][0]['PROPERTY_CURORT_VALUE']?></span>
											</div>
											<div class="col-md-6 ">

												<?if($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'] != NULL) { ?><span
													class="tur_discount">-<?=$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']?>
													%</span>
												<? } ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
													<span class="tur_price"><?if(!empty($tours[$k][0]['PROPERTY_DISCOUNT_VALUE'])){
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']-(($tours[$k][0]['PROPERTY_MIN_PRICE_VALUE']/100)*$tours[$k][0]['PROPERTY_DISCOUNT_VALUE']);
														}
														else
															echo $tours[$k][0]['PROPERTY_MIN_PRICE_VALUE'];
														?>	Р</span>
												<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: <?=FormatDateFromDB($tours[$k][0]['PROPERTY_DATEFROM_VALUE'], "DD.MM") ?></span>
												<span class="tur_night"><i class="calendar1"></i> Количество ночей: <?=$tours[$k][0]['PROPERTY_DAYCOUNT_VALUE'] ?></span>
												<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: <?= date('h:i'); ?></span>
											</div>
										</div>
									</div>
									<div class="hotdeals" data-url = "/content/tours/?id=<?=$k;?>">
										<?foreach ($tours[$k] as $tour):?>
											<div>
												<span><?= $tour['PROPERTY_DATEFROM_VALUE'] ?></span>
												<span><?= $tour['PROPERTY_DAYCOUNT_VALUE'] ?> дней</span>
												<span><?= $tour['PROPERTY_MIN_PRICE_VALUE'] ?> Р</span>
											</div>
										<?endforeach?>
									</div>
								</div>
								<?if( ($i - 1) % 2 == 0):?></div><?endif?>
								<?if ($i == 31) break;?>
								<?$i++?>
							<?endforeach?>
						</div>
					</div>
				</div>
			<?endif?>
		</div>
		<?
		/*
        далее мобильная версия...
        */
		?>


		<div class="container hotturblock-mobile">
			<h1 class="hottur">Горящие туры из моего города</h1>
			<div class="hot-carusel owl-carousel">
				<? foreach ($resr as $key => $t) { ?>
					<? if ($key == 0 || $key % 2 == 0) { ?><div class="item"><? } ?>

					<div class="wraps ">
						<div class="hotblocks">
							<div class="row">
								<div class="col-xs-6 ">
									<span class="tur_country"><?= $arProps[0]['COUNTRY']['VALUE'] ?></span>
									<span class="tur_city"><?= $arProps[0]['CURORT']['VALUE'] ?></span>
								</div>
								<div class="col-xs-6 ">
									<? if ($arProps[0]['DISCOUNT']['VALUE'] != NULL) { ?><span
										class="tur_discount">-<?= $arProps['DISCOUNT']['VALUE'] ?> %</span><? } ?>
									<span class="tur_price"><?if(!empty($arProps['DISCOUNT']['VALUE'])){
											echo $arProps['MIN_PRICE']['VALUE']-(($arProps['MIN_PRICE']['VALUE']/100)*$arProps['DISCOUNT']['VALUE']);
										}
										else
											echo $arProps['MIN_PRICE']['VALUE'];
										?> Р</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">

									<span class="tur_date"><i
											class="fa fa-plane redish"></i> Дата вылета: <?= FormatDateFromDB($arProps[0]['DATEFROM']['VALUE'], "DD.MM") ?></span>
									<span class="tur_night"><i
											class="calendar1"></i> Количество ночей: <?= $arProps[0]['DAYCOUNT']['VALUE'] ?></span>
									<span class="tur_update"><i
											class="fa fa-refresh redish"></i> Обновлено: <?= FormatDateFromDB($arFieldz[0]['TIMESTAMP_X'], "h:i") ?></span>
								</div>
							</div>
						</div>
						<div class="hotdeals">
							<? foreach ($arProps as $rw) { ?>
								<div>
									<span><?= date("d.m", strtotime($rw['DATEFROM']['VALUE'])) ?></span>
									<span><?= $rw['DAYCOUNT']['VALUE'] ?> дней</span>
									<span><?= $rw['MIN_PRICE']['VALUE'] ?> Р</span>
								</div>
							<? } ?>
						</div>
					</div>
					<? if ($key - 1 % 2 == 0 && $key != 0) { ?></div><? } ?>
					<?
					if ($key == 7) exit;
				} ?>
			</div>
		</div>


	</section>
<?endif?>
