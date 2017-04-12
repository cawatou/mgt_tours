<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
GLOBAL $city;
?>

 <div class="container lastblock" >
			<div class="row" >
				<div class="col-md-6 col-xs-6" style="padding: 0 10px;">
					
					<div >
						<div class="col-md-12  col-xs-12" style="border-bottom:2px solid #4d4d4d;padding-bottom:15px;">
							<i class="fa fa-navicon " style="color:#db3636;font-size:2em;"></i>
						</div>
					</div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"bottom", 
						Array(
							"ROOT_MENU_TYPE"	=>	"top",
							"MAX_LEVEL"	=>	"1",
							"USE_EXT"	=>	"N",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_CACHE_GET_VARS" => Array()
						)
					);?>
					
				</div>
				<div class="col-md-3 col-xs-6"   style="padding: 0 10px;">
					
					<div >
						<div style="border-bottom:2px solid #4d4d4d;padding-bottom:15px;">
							<i class="fa  fa-phone " style="color:#db3636;font-size:2em;"></i>
						</div>
					</div>
					<div class="phones">
					<p class="p1"> </p>
					<p class="p2"> </p>
					</div>
					<a class="callmeback" data-toggle="modal" data-target="#callback"><i class="fa  fa-volume-control-phone "></i> &nbsp; Заказать обратный звонок</a>
					
					<div class="socials">
						<a href="#" target=_blank class=" vk"></a>
						<a href="#" target=_blank class=" inst"></a>
						<a href="#" target=_blank class=" ok"></a>
						<a href="#" target=_blank class=" fb"></a>
					</div>
					
					<h3>Мы принимаем:</h3>
					<div class="cards">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/card_18.png"  alt="Visa, Mastercard">
					</div>
					
				</div>
				<div class="col-md-3 col-xs-6"  style="padding: 0 10px;">
					<div >
						<div class="footline"></div>
					</div>
					<div class="fns">
						<p >Информация о ценах, указанная на сайте, является ориентировочной, не является ни рекламой, ни офертой</p>
						<div class="row" >
							<div class="col-md-6  col-xs-12" >
								<img src="<?=SITE_TEMPLATE_PATH?>/images/fns_03.jpg" alt="">
								<p>Здесь вы можете узнать вашу задолженность по налогам.</p>
							</div>
							<div class="col-md-6  col-xs-12" >
								<img src="<?=SITE_TEMPLATE_PATH?>/images/fns_06.jpg" alt="">
								<p>Информирование о задолженности граждан в рамках исполнительного производства.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?$APPLICATION->ShowPanel();?>