<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск отеля в стране");
GLOBAL $countryName;
GLOBAL $tourvisorID;
define("AUTH","i@neoz.su");
define("PASS","jICPOQJ7");
/*
echo '<pre>';
var_dump($_REQUEST);
echo '</pre>';
*/
$ID_CNTRY = "";
if(isset($_REQUEST["ID"])) {
	$ID_CNTRY = $_REQUEST["ID"];
}
else {
	
	$tourvisorID = $_REQUEST["TID"];
	
	CModule::IncludeModule("iblock");
	$arSelect1 = Array("ID","NAME","IBLOCK_ID","DETAIL_TEXT","PREVIEW_PICTURE","PROPERTY_TURVID");
	$arFilter1 = Array("IBLOCK_ID"=>21,"PROPERTY_TURVID"=>IntVal($tourvisorID));
	$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, Array("nPageSize"=>50), $arSelect1);

	
	while($ob = $res1->GetNextElement())
	{
		$arrFie = $ob->GetFields();
		$ID_CNTRY = $arrFie['PROPERTY_TURVID_VALUE'];
	}
	
}

?>
<style>
body {
	background:url(/bitrix/templates/tour/images/bgr/country_bg.jpg);
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
.itemcoutry {
	margin-top:160px;
}
.img {
	width:398px;
	height:314px;
	overflow:hidden;
	border-radius:5px;
}
.country-carousel {
	background:rgba(255,255,255,.8);
	padding:60px 110px;
	border-radius:5px;
}
.catcnsearch  {
	text-align:center;
	margin:60px 0 40px 0;
}
h3 {
	font-size:30px;
	font-weight:bold;
	color:#fff;
	text-align:center;
}
.catcnsearch i {
    border-radius: 50%;
    background: #eae4e0;
    color: #db3636;
    width: 38px;
    height: 38px;
    line-height: 38px;
}
.finder {
	background:#fff;
	padding:30px;
	border-radius:5px;
}
.btnfind {
	color:#fff;
	background:#db3636;
	border-radius:0 0 5px 5px;
	border:none;
	float: right;
	padding: 17px 75px;
	font-size:18px;
	font-weight:bold;
}
h3.topc {
	background:url(/bitrix/templates/tour/images/tours_14.png) no-repeat center top;
	padding-top:40px;
}
.switchlang {
	font-size:16px;
	font-weight:bold;
	color:#808080;
	background:rgba(255,255,255,.8);
	line-height: 40px;
    display: inline-block;
    padding: 0 26px;
}
.switchlang.selec {
	background:#fff;
	color:#db3636;
}
.sliderhotel {
	background:rgba(255,255,255,.7);
	padding:20px;
	border-radius:5px;
	margin-bottom:50px;
	margin-top:35px;
}
.sliderhotel .switchlang:first-child{
	border-radius:5px 0 0 5px;
}
.sliderhotel .switchlang:last-child{
	border-radius:0 5px  5px 0;
}
.word a {
	color:#313131;
	font-size:15px;
	font-weight:bold;
	background:rgba(255,255,255,.8);
	border-radius:5px;
	padding: 8px;
    margin-right: 5px;
    cursor: pointer;
    display: inline-block;
    line-height: 10px;
}
.sliderhotel h4 {
	font-size:16px;
	color:#fffefe;
	font-weight:bold;
	text-transform:uppercase;
	margin-top:0;
}
.sliderhotel .hotel_star {
	color:#ffc000;
	display: inline-block;
    margin: 2px 0;
}
.sliderhotel .hotel_price {
	color: #db3636;
    background-color: #fff;
    border-radius: 3px;
    font-size: 13px;
    padding: 3px;
	 font-weight: bold;
	 display:inline-block;
}
.sliderhotel .hotel_eat {
    color: #fff;
    font-weight: bold;
    font-size: 13px;
    margin: 8px 0;
	width: 84%;
}
.sliderhotel .hotel {
	background:url(/bitrix/templates/tour/images/big_pic_06.jpg) no-repeat center center;
	background-size: cover;
	border-radius:5px;
    padding: 18px;
	cursor:pointer;
}
.letter { display:none}
.letter.sels { display:block;    padding: 7px 0;}
.letter.sels .act{ background:#db3636;color:#fff;}
.hotel-carusel  {
	margin-top:20px;
}
.sliderhotel .hotel:first-child {
    margin-bottom: 20px;
}
</style>
<div class="container itemcoutry">
<?
if(!empty($ID_CNTRY))
$APPLICATION->IncludeComponent("bitrix:news.detail", "country", Array(
		"DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "Y",
        "SHARE_HIDE" => "N",
        "SHARE_TEMPLATE" => "",
        "SHARE_HANDLERS" => array("delicious"),
        "SHARE_SHORTEN_URL_LOGIN" => "",
        "SHARE_SHORTEN_URL_KEY" => "",
        "AJAX_MODE" => "Y",
        "IBLOCK_TYPE" => "city",
        "IBLOCK_ID" => "21",
        "ELEMENT_ID" => $ID_CNTRY,
        "ELEMENT_CODE" => "",
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => Array("ID"),
        "PROPERTY_CODE" => Array("DESCRIPTION"),
        "IBLOCK_URL" => "/catalog/",
        "DETAIL_URL" => "",
        "SET_TITLE" => "Y",
        "SET_CANONICAL_URL" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_STATUS_404" => "Y",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Страница",
        "PAGER_TEMPLATE" => "",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SHOW_404" => "Y",
        "MESSAGE_404" => "",
        "STRICT_SECTION_CHECK" => "Y",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N"
		)
		);
	else {
		echo "<h1 style='color:#fff;'>В базе отсутствует информация о стране</h1>";
	}

?>
	<div class="row">
		<div class="col-md-12 catcnsearch">
			<i class="fa fa-search "></i>
			<h3 >Поиск отеля</h3>
		</div>
	</div>
	
	<div class="row finder">
		<div class="col-md-4">
			<div class="form-group">
				<label>Название курорта</label>
				<select  name="srch_kur_name" class="form-control"> 
					<option value="" > сделайте выбор </option>
					<? 
					$json = file_get_contents("http://tourvisor.ru/xml/list.php?format=json&type=region&regcountry=". $tourvisorID."&authlogin=".AUTH."&authpass=".PASS."");
					$arr = json_decode($json);

					foreach($arr->lists->regions->region as $r){
					?>
					<option value="<?=$r->id?>"><?=$r->name?></option>
					<?} ?>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Категория отеля</label>
				<select  name="srch_cat_name" class="form-control">
					<option value="" > сделайте выбор </option>
					<option value="family" > семейный</option>
					<option value="active" > активный</option>
					<option value="city" >городской</option>
					<option value="deluxe" >Люкс (VIP)</option>
					<option value="health" >здоровье</option>
					<option value="relax"> спокойный</option>
					<option value="beach" >пляжный</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Введите название отеля</label>
				<input type="text" name="srch_hotel_name" class="form-control" placeholder="Введите название отеля">
			</div>
		</div>
	</div>
	<div class="row ">
		<div class="col-md-12">
			<button class="btnfind"><i class="fa fa-search"></i> &nbsp; Найти</button>
		</div>
	</div>
	<div class="row ">
		<div class="col-md-12">
			<h3 class="topc">Топ отелей <?=$countryName?></h3>
		</div>
	</div>
	<?
$langEn = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$langRu = array("А","Б","В","Г","Д","Е","Ж","З","И","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Э","Ю","Я");


$json = file_get_contents("http://tourvisor.ru/xml/list.php?format=json&type=hotel&hotcountry=". $tourvisorID."&authlogin=".AUTH."&authpass=".PASS."");
$arr = json_decode($json);
	?>
	<div class="sliderhotel ">
		<div class="row ">
			<div class="col-md-2">
				<a class="switchlang" data-letter="rus">Рус</a>
				<a class="switchlang selec " data-letter="eng">Eng</a>
			</div>
			<div class="col-md-10 word">
				<div class="letter rus">
				<?
					foreach($langRu as $w) {
						echo '<a data-index="'.$w.'" >'.$w.'</a>';
					}
				?>
				</div>
				<div class="letter eng sels">
				<?
					foreach($langEn as $w) {
						echo '<a data-index="'.$w.'" >'.$w.'</a>';
					}
				?>
				</div>
			</div>
		</div>
		<div class="container-fluid">
		<div class="grid">
			 <div class="grid-sizer col-md-3"></div>
		<?$k=0;
		foreach($arr->lists->hotels->hotel as $j => $h){?>
			<div class="grid-item col-md-3" onclick="window.location.href='/catalog/hotel/<?=$h->id?>'" <?if($j>7){?>style="display:none"<?}?>>
				<div class="hotel nobgr" data-firstletter="<?=$h->name{0}?>" data-regions="<?=$h->region?>" data-type="<?
				if(isset($h->city)) echo"city";
				if(isset($h->health)) echo"health";
				if(isset($h->relax)) echo"relax";
				if(isset($h->family)) echo"family";
				if(isset($h->active)) echo"active";
				if(isset($h->beach)) echo"beach";
				if(isset($h->deluxe)) echo"deluxe";
				?>" data-hid="<?=$h->id?>">
					<h4><?=$h->name?></h4>
					
					<div class="hotel_star">
					<?for($i=1;$i<=$h->stars;$i++) {
						?><span class="fa fa-star yellow"></span><?
					}?>
					</div>
					
					<p class="hotel_eat">&nbsp;</p>
					
					<span class="hotel_price">&nbsp;</span>
				</div>
			</div>
			
		<?}?>
		</div>
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