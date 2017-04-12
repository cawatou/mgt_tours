<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");?>
<style>
.ddwn, .ddwn2 {
	position: absolute;
    top: 76px;
    background: #fff;
    color: #333;
    width: 100%;
    height: 200px;
    z-index: 100;
    overflow-y: auto;
	display:none;
}
.ddwn p, .ddwn2 p{
	margin: 0;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
	color:#333;
}

body {
	background:url(/bitrix/templates/tour/images/bgr/catcountry_bg.jpg);
	background-attachment:fixed;
	background-size:cover;
}
.navbar {
	position:fixed !important;
	background:rgba(0,0,0,0.5);
	z-index:2 !important;
}

.footer-all {
	background-color:#212121;padding-top: 50px;
    padding-bottom: 150px;
}
a:hover{
	text-decoration:none;
	color:#fff;
}
.overflow {
	background:rgba(255,255,255,0.8);
	padding:40px;
	border-radius:5px;
}
.overflow .item:hover{
	opacity:.9;
}

.overflow .item{
	width:259px;
	height:178px;
	border-radius:5px;
	background-size: cover !important;
	margin: 0 auto;
	cursor:pointer;
}
.overflow .item a{
	text-transform:uppercase;
	color:#fff;
	font-weight:bold;
	font-size:20px;
	display: block;
    height: 100%;
    padding: 30px;
}
.overflow .nextr{
	margin-top:30px;
}
.overflow .col-md-3{
	padding:0;
}
.catalogcountry {
	margin-top:80px;
}
.catalogcountry h2{
	margin-top:65px;
	margin-bottom:40px;
	text-align:center;
	color:#fff;
	font-size:30px;
	font-weight:bold;
}
.flag:hover > img{
	opacity:.6;
}
.flag {
	display:block;
	color:#fff;
	font-size:20px;
	font-weight:bold;
	margin:20px 0;
}
.flag img{
	width:50px;
	margin-right:30px;
}
.nopad {
	padding:0;
}
.srchpls input{
	border-radius: 5px 0 0 5px;
	font-size:20px;
	color:#333;
	border:none;
	line-height:74px;
	width: calc(100% - 78px);
	padding: 0 20px;
}
.srchpls .find:hover, .srchpls .find:active {
	background:#ef4c44;
}
.srchpls .find {
	color:#fff;
	background:#db3636;
	border-radius:0 5px 5px 0;
	border:none;
	width:74px;
	height:74px;
	float: right;
}
.srchpls {
	display:inline-block;
	width: 47%;
    vertical-align: baseline;
	position:relative;
}
.forma span {
	display:inline-block;
	color:#fff;
	font-size:20px;
	font-weight:bold;
	margin: 0 14px;
}



</style>
<div class="container catalogcountry">
	<div class="row">
		<div class="col-md-12">
			<h2>Страны и направления</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 forma">
			<div class="srchpls">
				<div class="ddwn"></div>
				<input type="text" name="countryname"  placeholder="Введите название страны">
				<button class="find fa fa-search"></button>
			</div>
			<span>или</span>
			<div class="srchpls">
				<div class="ddwn2"></div>
				<input type="text" name="hotelname" disabled placeholder="Введите название отеля">
				<button class="find fa fa-search hotelsearh"></button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>Популярные страны</h2>
		</div>
	</div>
	<div class="overflow">
	<?
	
	global $arrFilter;
	$arrFilter = array(
		"PROPERTY_POPULAR" => 5
	);
	?>
	
	<?$APPLICATION->IncludeComponent("bitrix:news.list", "country", Array(
					"IBLOCK_TYPE"	=>	"city",
					"IBLOCK_ID"	=>	"21",
					"NEWS_COUNT"	=>	"8",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"arrFilter",
					"FIELD_CODE"	=>	array(
					),
					"PROPERTY_CODE"	=>	array(
						0	=>	"POPULAR",
						1	=>	"TURVID",
						2	=>	"FLAG",
					),
					"DETAIL_URL"	=>	"/catalog/country/bx#ELEMENT_ID#",
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
					"PAGER_TITLE"	=>	"Вакансии",
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
	<div class="row">
		<div class="col-md-12">
			<h2>Все направления</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 allcountry">
			
		</div>
	</div>
</div>

<div class="container-fluid footer-all" >
<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("footer_inc.php"),
			Array(),
			Array("MODE"=>"html")
		);?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>