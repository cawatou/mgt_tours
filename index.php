<?
GLOBAL $cityArr,$operatorArr,$countryArr,$TVID,$User_city;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Мой горящий тур");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная");

/****/
$arSelect = Array("ID","IBLOCK_ID","NAME","PROPERTY_REAL_PICTURE","PROPERTY_SECT_ID");
$arFilter = Array("IBLOCK_ID"=>9, "SECTION_ID"=>148 );
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false,Array("nPageSize"=>10000),$arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arr[$arFields["PROPERTY_SECT_ID_VALUE"]]['name'] = $arFields["NAME"];
	$arr[$arFields["PROPERTY_SECT_ID_VALUE"]]['src'] = CFile::GetPath($arFields["PROPERTY_REAL_PICTURE_VALUE"]);
}

/****/
$topNews = "";
$arSelect = Array("ID","IBLOCK_ID","NAME","PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>2, "PROPERY_TOPNEWS"=>"Да" );
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false,Array("nPageSize"=>10000),$arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$topNews = $arFields["PREVIEW_TEXT"];
}
?>
<div id="fullPage">
	<section class="vertical-scrolling showcase_tours" style="background:url('<?= $arr[1]['src'] ?>') no-repeat center center;">
		<div class="container tourmain" >
			<div class="row">
				<div class="col-md-12"><h2><?= $arr[1]['name'] ?></h2></div>
			</div>
			<?if(!empty($topNews)){?>
				<div class="topNews">
					<i class="closeNews">X</i>
					<?=$topNews?>
				</div>
			<?}?>
		</div>
		<form id="startsearch">
			<div class="container formazaprosa">
				<div class="row">
					<div class="fpadd">
						<ul>
							<li class="fz_block">
								<span class='search_title'>Город вылета</span>
								<select name="cityID" class="fz-city" style="border:none"></select>
							</li>
							<li class="fz_block">
								<span class='search_title'>Страна</span>
								<select name="countryID" style="border:none"></select>
							</li>
							<li class="fz_block">
								<span class='search_title'>Дата вылета</span>
								<div class="form-group">
									<div class="input-group date">
										<input type="text" name="daterangefly" class="form-control"
											   placeholder="Выберите дату"/>
										<span class="input-group-addon">
										  <span class="calendarico "></span>
										</span>
									</div>
								</div>
							</li>
							<li class="fz_block">
								<span class='search_title'>Количество ночей</span>
								<div>
									от <select class="cday" name="night_ot">
										<option>выбор</option>
										<?for($i=1;$i<=28;$i++){?>
										<option value="<?=$i?>"><?=$i?></option>
										<?}?>
									</select>
									до
									<select class="cday" name="night_do">
										<option></option>
									</select>
								</div>
							</li>
							<li class="fz_block" style="position:relative;">
								<span class='search_title'>Туристы</span>
								<span class="pplcount ">Количество туристов <i class="fa fa-sort-down"></i></span>
								<div class="pplpopup">
									<h3>Взрослых</h3>
									<span class="turist" data-count="1"><i class="fa fa-user fa-lg"></i></span>
									<span class="turist" data-count="2" style="color: rgb(219, 54, 54);"><i
											class="fa fa-user fa-lg"></i><i class="fa fa-user fa-lg"></i></span>
									<span class="turist" data-count="3"><i class="fa fa-user fa-lg"></i><i
											class="fa fa-user fa-lg"></i><i class="fa fa-user fa-lg"></i></span>
									<span class="turist" data-count="4"><i class="fa fa-user fa-lg"></i><i
											class="fa fa-user fa-lg"></i><i class="fa fa-user fa-lg"></i><i
											class="fa fa-user fa-lg"></i></span>
									<input type="text" name="adult" value="2" style="display:none;">
									<br style="clear:both">
									<h3>Детей</h3>
									<span class="childs" data-count="1"><i class="fa fa-user "></i></span>
									<span class="childs" data-count="2"><i class="fa fa-user "></i><i
											class="fa fa-user "></i></span>
									<span class="childs" data-count="3"><i class="fa fa-user "></i><i
											class="fa fa-user "></i><i class="fa fa-user"></i></span>
									<span class="childs" data-count="4"><i class="fa fa-user "></i><i
											class="fa fa-user "></i><i class="fa fa-user "></i><i
											class="fa fa-user "></i></span>
									<input type="text" name="child" value="0" style="display:none;">
									<div class="childyear"></div>
									<br style="clear:both">
									<div style="text-align:center;">
										<button type="button" class=" pplchoise">Выбрать</button>
									</div>
								</div>
							</li>
						</ul>

						<div class="search_btn">
							<button type="button" class="btn btn-default btn-lg searchall">
								<span class="glyphicon glyphicon-search" aria-hidden="true" style="color:#fff;"></span>
							</button>
						</div>


						<br style="clear:both;">
					</div>
				</div>
				<div class="row">
					<div class="fullsearch">
						<a href="/search/">+&nbsp;Расширенный поиск</a>
					</div>
				</div>
			</div>
		</form>
		<div class="container hotindex">
			<div class="row">
				<div class="col-md-6 hotcy">
					<div class="hotcity">
						Горящие туры и путевки из
						<div class="dropdown">
							<select class="city-toggler city_departure departure" name="city_departure">
								<option value="0">Выберите город</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-md-offset-4" style="text-align:right">
					<div class="hotlist"><span class="fa fa-list-ul"></span></div>
					<div class="hotthumb active"><span class="thumb"></span></div>
				</div>
			</div>
			
			<?/*========================= Подгружается через ajax из файла /ajax/dev.php =================================*/?>
			
		</div>
	</section>

	<section class="vertical-scrolling sibling_tours"  style="background:url('<?=$arr[3]['src']?>') no-repeat center center;">
        <h1 class="hottur"><?=$arr[3]['name']?></h1>
			
		<div class="container hotturblock" >	
			<div class="row r25">
				<div class="col-md-3 " >
					<div class="hotblocks">
					<div class="row">
						<div class="col-md-6 ">
							<span class="tur_country">Тайланд</span>
							<span class="tur_city">Патайя</span>
						</div>
						<div class="col-md-6 ">
							<span class="tur_discount">-25%</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<span class="tur_price">20 000 Р</span>
							<span class="tur_start">из кемерово</span>
							
							<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: 18.01</span>
							<span class="tur_night"><i class="calendar1"></i> Количество ночей: 7</span>
							<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: 5 февраля в 15:30</span>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container hotturblock-mobile" >
			<div class="hot-carusel owl-carousel">
				<div class="item">
					<div class="wraps " >
						<div class="hotblocks">
							<div class="row">
								<div class="col-xs-6 ">
									<span class="tur_country">Тайланд</span>
									<span class="tur_city">Патайя</span>
								</div>
								<div class="col-xs-6 ">
									<span class="tur_discount">-25%</span>
									<span class="tur_price">20 000 Р</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									
									<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: 18.01</span>
									<span class="tur_night"><i class="calendar1"></i> Количество ночей: 7</span>
									<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: 5 февраля в 15:30</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    <section class="vertical-scrolling"  style="background:url('<?=$arr[4]['src']?>') no-repeat center center;">
        <h1 class="poputchik"><?=$arr[4]['name']?></h1>
		<div class="container poputchiki">
			<div  class="poputki owl-carousel r25">
			<?$APPLICATION->IncludeComponent("bitrix:news.list", "companion", Array(
					"IBLOCK_TYPE"	=>	"companion",
					"IBLOCK_ID"	=>	"17",
					"NEWS_COUNT"	=>	"10",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"",
					"FIELD_CODE"	=>	array(
					),
					"PROPERTY_CODE"	=>	array(
						0	=>	"comp_name",
						1	=>	"com_coment",
					),
					"DETAIL_URL"	=>	"/content/companion/#ELEMENT_ID#/",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"0",
					"ACTIVE_DATE_FORMAT"	=>	"j M Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"N",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"Попутчики",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"Y",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y",
					"DETAIL_FIELD_CODE" => array(
						  0 => "SHOW_COUNTER",
						  1 => "",
					   )
					)
					);?>
			</div>
			
			<a href="/content/companion/" class="btnusers">посмотреть всех попутчиков</a>
		</div>
		
    </section>
    <section class="vertical-scrolling"  id="articles" >
		<div class="container reviewnart">
			<div  class="row " >
				<div class="col-md-6 col-xs-12 reviews" >
					<h1 ><?=$arr[5]['name']?></h1>
					<div  class="row owl-carousel reviewes" >
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "review", Array(
					"IBLOCK_TYPE"	=>	"services",
					"IBLOCK_ID"	=>	"12",
					"NEWS_COUNT"	=>	"5",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"",
					"FIELD_CODE"	=>	array(	),
					"PROPERTY_CODE"	=>	array(
						0	=>	"NAME",
						1	=>	"",
					),
					"DETAIL_URL"	=>	"/content/review/#ELEMENT_ID#/",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"0",
					"ACTIVE_DATE_FORMAT"	=>	"j M Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"N",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"Попутчики",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"Y",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y",
					"DETAIL_FIELD_CODE" => array(
						  0 => "SHOW_COUNTER",
						  1 => "",
					   )
					)
					);?>
					
						
					</div>
					<a href="#" class="reviewlink" data-toggle="modal" data-target="#addrewiev">оставить отзыв</a>
				</div>
				<style>
				.redbot:hover {
					color:#333;
					border-bottom:2px solid #fff;
					text-decoration:none;
				}
				.redbot {
					font-size:13px;
					font-weight:bold;
					color:#333;
					border-bottom:2px solid #db3636;
				}
				.loadpic {
					margin: 20px 0;
					display: inline-block;
				}
				.bigbtn {
					color: #fff;
					background: #db3636;
					padding: 12px 76px;
					font-size: 16px;
					font-weight: bold;
					text-transform: uppercase;
					border-radius: 25px;
					display: inline-block;
				}
				</style>
				<div class="col-md-6 col-xs-12 articles" >
				<?
				GLOBAL $filterArt;
				$filterArt = array(
					"PROPERTY_TOPNEWS_VALUE"=> "Нет"
				);
				$APPLICATION->IncludeComponent("bitrix:news.list", "articles", Array(
					"IBLOCK_TYPE"	=>	"articles",
					"IBLOCK_ID"	=>	"2",
					"NEWS_COUNT"	=>	"2",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"filterArt",
					"FIELD_CODE"	=>	array(
					),
					"DETAIL_URL"	=>	"/content/articles/#ELEMENT_ID#/",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"0",
					"ACTIVE_DATE_FORMAT"	=>	"j M Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"N",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"Статьи",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"N",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y"
					)
					);?>
				</div>
			</div>
		</div>
				
	</section>  
    <section class="vertical-scrolling"  id="franchize">
        <div class="container franch" >
			<div  class="row row-flex row-flex-wrap" >
				<div class=" col-md-6  col-xs-12 pc-ver" >
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "franchize", Array(
					"IBLOCK_TYPE"	=>	"services",
					"IBLOCK_ID"	=>	"1",
					"NEWS_COUNT"	=>	"3",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"",
					"FIELD_CODE"	=>	array(	),
					"DETAIL_URL"	=>	"/content/franchize/#ELEMENT_ID#/",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"0",
					"ACTIVE_DATE_FORMAT"	=>	"j M Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"N",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"Франшиза",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"PAGER_SHOW_ALL" => "N",
					"PARENT_SECTION_CODE" => "franchiz",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"Y",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y",
					"DETAIL_FIELD_CODE" => array(
						  0 => "SHOW_COUNTER",
						  1 => "",
					   )
					)
					);?>
					
				</div>
				<div class=" col-md-6  col-xs-12 mobile-section" >
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "training", Array(
					"IBLOCK_TYPE"	=>	"services",
					"IBLOCK_ID"	=>	"4",
					"NEWS_COUNT"	=>	"3",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"",
					"FIELD_CODE"	=>	array(	),
					"DETAIL_URL"	=>	"/content/training/#ELEMENT_ID#/",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"0",
					"ACTIVE_DATE_FORMAT"	=>	"j M Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"N",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"Франшиза",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"PAGER_SHOW_ALL" => "N",
					"PARENT_SECTION_CODE" => "training",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"Y",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y",
					"DETAIL_FIELD_CODE" => array(
						  0 => "SHOW_COUNTER",
						  1 => "",
					   )
					)
					);?>
					
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
    </section>
	
    <section id="ourpeople" class="vertical-scrolling" >
        <h1 class="ourpeople"><?=$arr[7]['name']?></h1>
		<div class="container ourpeoples">
			<div class="row">
				<div class="col-md-10 col-xs-12">
					<div class="row owl-carousel workers">
						<?
						GLOBAL $emplFilter,$officeForCity;
						$PROPoffice = "";
						$arSelect1 = Array("ID","NAME","IBLOCK_ID");
		$arFilter1 = Array("SECTION_ID"=>IntVal($officeForCity));
		$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, Array("nPageSize"=>50), $arSelect1);
		while($ob = $res1->GetNextElement()){
			 $arFields2 = $ob->GetFields();
			 $PROPoffice .="".$arFields2['ID']." | ";
		}
		$PROPoffice = substr($PROPoffice, 0, -3);
		
						$emplFilter = array(
							"?PROPERTY_OFFICE" => $PROPoffice,
						);
						$APPLICATION->IncludeComponent("bitrix:news.list", "employment", Array(
					"IBLOCK_TYPE"	=>	"books",
					"IBLOCK_ID"	=>	"7",
					"NEWS_COUNT"	=>	"5",
					"SORT_BY1"	=>	"PROPERTY_winner",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"NAME",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"emplFilter",
					"FIELD_CODE"	=>	array(	),
					"PROPERTY_CODE"	=>	array(
						0	=>	"NAME",
						1	=>	"",
					),
					"DETAIL_URL"	=>	"/content/employe/#ELEMENT_ID#/",
					"CACHE_TYPE"	=>	"A",
					"CACHE_TIME"	=>	"3600",
					"CACHE_FILTER"	=>	"N",
					"PREVIEW_TRUNCATE_LEN"	=>	"0",
					"ACTIVE_DATE_FORMAT"	=>	"j M Y",
					"DISPLAY_PANEL"	=>	"N",
					"SET_TITLE"	=>	"N",
					"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
					"ADD_SECTIONS_CHAIN"	=>	"Y",
					"HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
					"PARENT_SECTION"	=>	"",
					"DISPLAY_TOP_PAGER"	=>	"N",
					"DISPLAY_BOTTOM_PAGER"	=>	"N",
					"PAGER_TITLE"	=>	"Попутчики",
					"PAGER_SHOW_ALWAYS"	=>	"N",
					"PAGER_TEMPLATE"	=>	"",
					"PAGER_DESC_NUMBERING"	=>	"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE"	=>	"Y",
					"DISPLAY_NAME"	=>	"Y",
					"DISPLAY_PICTURE"	=>	"Y",
					"DISPLAY_PREVIEW_TEXT"	=>	"Y",
					"DETAIL_FIELD_CODE" => array(
						  0 => "SHOW_COUNTER",
						  1 => "",
					   )
					)
					);?>
					</div>
				</div>
				<div class="magic" >
					<div class="addme">
						<h3>Менеджер по туризму</h3>
						<p>Идейные соображения высшего порядка, а также укрепление и развитие структуры позволяет оценить значение системы обучения кадров, соответствует насущным потребностям.</p>
						<div class="awrap"><a href="/content/job/">Хочу стать сотрудником</a></div>
					</div>
				</div>
			</div>
		</div>
		<a href="/content/employe/" class="reviewlink">все сотрудники</a>
    </section>
	<section class="vertical-scrolling"  >
		<?
		
		
$APPLICATION->IncludeComponent("bitrix:map.google.view",".default",array(
    "API_KEY" => "AIzaSyDVcwlJJsdy7gvq6LePrBSLE5UvPuIqrvg",
	"INIT_MAP_TYPE" => "MAP",
	"MAP_DATA" => serialize(
                  array(
                     'google_lat' => $MAP[0], // координаты центра карты
                     'google_lon' => $MAP[1], // используем координаты последнего маркера
                     'google_scale' => 10, // масштаб карты 0-20
                     'PLACEMARKS' => $PLACEMARKS // подготовленный ранее массив маркеров
                     )
               ),
    "MAP_WIDTH" => "100%",
    "MAP_HEIGHT" => "100%",
    "CONTROLS" => array(
            
        ),
    "OPTIONS" => array(
            
            "ENABLE_DBLCLICK_ZOOM",
            "ENABLE_DRAGGING",
            "ENABLE_KEYBOARD"
        ),
    "MAP_ID" => "googlemaps2"
    )
);?>
		
		<div class="mapbgr"></div>
		<div class="mapover">
			<h1 >Адреса офисов</h1>
			<div class="container-fluid owl-carousel office-carousel">
				
			</div>
		</div>
    </section> 
	<section class="vertical-scrolling"  style="background:#212121;">
      <?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("footer_inc.php"),
			Array(),
			Array("MODE"=>"html")
		);?>
    </section>
</div>
<footer class="footer" style="background-color:#2b2b2b;">
     <div style="display:inline-table;width:100%;"> 
        <div class="tds subscribe">
			
			<input type="text" name="subs_email" placeholder="Подписка на e-mail рассылку" class="subscinp">
			<button type="submit" class="subscbtn"><i class="fa fa-envelope" style="color:#d74025;"></i> &nbsp;Подписаться</button>
		</div>
		<div class="tds social">
			<span>Подписаться:</span>
			<a data-toggle="modal" data-target="#soc" class="subscr whatsap" href="#"></a>
			<a data-toggle="modal" data-target="#soc" class="subscr viber" href="#"></a>
			<a data-toggle="modal" data-target="#soc" class="subscr telegram" href="#"></a>
			<a data-toggle="modal" data-target="#soc" class="subscr sms" href="#"></a>
		
		</div>
		<div class="tds footer_link">
			<span class="slideMenu fa fa-angle-up "  > </span>
			<a href="/catalog/online/" class="whited">Купить тур онлайн</a>
			<a href="#" data-toggle="modal" data-target="#orderfor" >Отправить заявку на тур</a>
			<a href="#" data-toggle="modal" data-target="#question">Задать вопрос</a>
		</div>
		</div>
		
    </footer>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>