<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Где купить");
?>

<style>
body {
	/*background:url(/bitrix/templates/tour/images/bgr/map_bgr.jpg);*/
	
}
.navbar li, .navbar .callback{
	
}
.navbar {
	position:fixed !important;
	background-color:#fff;
	background:rgba(0,0,0,0.5);
	z-index:2 !important;
}
.expandMenu .line {
    border-top: 1px solid #333333;
}	
.footer-all {
	background-color:#212121;padding-top: 50px;
    padding-bottom: 150px;
}
.wherebuy {
	backgroun-color: #fff;
}
.wherebuy h1{
	font-size:30px;
	font-weight:bold;
	margin-top:160px;
	margin-bottom:50px;
}
ol {
	padding:0;
}
ol li{
	list-style:none;
}
ol li a{
	font-size:13px;
	text-decoration:underline;
}

.listblockcity  {
	height:560px;
}
.listblockcity p {
	    margin: 5px 0;
}
.listblockcity a {
	color:#333;
	text-decoration:underline;

    margin: 0 !important;
    font-size: 0.7em;
}
.listblockcity a:hover {
	text-decoration:none;
}
.listblockcity a.active {
	color:#db3636;
	text-decoration:none;
}
.listblockcity h3 {
	float: left;
    width: 17px;
    color: #db3636;
    margin: 0;
    padding: 5px 0;
    font-size: 1em;
}
.listblockcity #cityx {
	padding: 0;
}
#listcity .letterlist {
	float: left;
    width: 99px;
    border-left: 1px solid #ddd;
    padding-left: 5px;
}
#listcity li {
	display: inline-block;
    text-align: left;
    border: 0;
   
	margin-bottom: 15px;
    width: 100% !important;
	margin-bottom: 15px;
}
#listcity {

}
.office-box .office-adress b{
	display:block;
}
.office-box {
    background: #fff;
    border-radius: 5px;
    border: 1px solid #e5e5e5;
    position: absolute;
    z-index: 11;
    margin-left: -550;
    left: 50%;
    height: 220px;
    margin-top: -110px;
	padding: 30px;
}

.calendar2 {
	display: inline-block;
    cursor: pointer;
    width: 11px;
    height: 11px;
    background: url(/bitrix/templates/tour/images/calendar2_03.png) no-repeat center;
	
}
.office-box-info{
	padding:0;
	list-style:none;
}
.office-box-info li i{
	margin-bottom: 10px
}
.office-box-info li{
	float:left;
	width:50%;
	font-size:13px;
}
.people img {
	border-radius:50%;
	width:72px;
	height:72px;
	margin: 0 auto;
}
.people {
	width:90px;
	margin:0 auto;
	    height: 158px;
    display: table-cell;
    vertical-align: middle;
}
.people p {
	text-align:left;
	font-size:10px;
}
.people b {
	display:block;
	font-size:13px;
}
.people span {
	text-transform:uppercase;
}
.peopl-carusel .owl-prev {
    top: -110px;
    left: -50px;
}
.peopl-carusel .owl-next {
    top: -110px;
    right: -50px;
}
p.office-adress {
	margin-bottom:20px;
	width: 90%;
}
/*******************************************for mobile ******************************************/
@media all and (max-width:1000px){
	.wherebuy h1 {
		font-size: 20px;
		margin-top: 60px;
		margin-bottom: 20px;
	}
	
	.listblockcity {
		height: 859px;
	}
	.office-box-info li {
		font-size: 10px;
	}
	p.office-adress {
		margin-bottom: 10px;
		font-size: 13px;
	}
	.office-box {
		left: 0;
		height: 270px;
		padding: 15px;
		max-width: 300px;
		margin: -110px 10px 0 10px;
	}
}
</style>
<div class="wherebuy">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<h1>Где купить</h1>
				<div class="listblockcity">
					<ol id="listcity"><?=$citychko?></ol>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container office-box">
	<div class="row">
		<div class="col-md-4 col-xs-12 reloadOffice">
		<?
		CModule::IncludeModule("iblock");
		$arSelect1 = Array("ID","NAME","IBLOCK_ID","PROPERTY_*");
		$arFilter1 = Array("SECTION_ID"=>IntVal($officeForCity));
		$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, Array("nPageSize"=>50), $arSelect1);

		$i =0;
$PLACEMARKS = array();
		$ob = $res1->GetNextElement();
		
		 $arFields2 = $ob->GetFields();
		// print_r($arFields2);
		 $arProps = $ob->GetProperties();
		 //print_r($arProps['office_latlong']);
		
		$MAP = explode(",", $arProps["office_latlong"]["VALUE"]);
		$PLACEMARKS[$i]["LON"] = $MAP[1]; //Заполняем массив маркера данными
        $PLACEMARKS[$i]["LAT"] = $MAP[0];
		$PLACEMARKS[$i]["TEXT"] = $arProps['office_adres']['VALUE'];
		
		$jobOffice = $arFields2['ID'];
		
		if($arProps['office_adres']['VALUE']!='') {?>
			
			<p class="office-adress"><b><?=$arFields2['NAME']?></b><?=$arProps['office_adres']['VALUE']?></p>
			<ul class="office-box-info">
				<li>
					<i class="calendar2"></i>
					<p><b>Пн-Пт:</b> <?=$arProps['office_hours']['VALUE']?></p>
					<p><b>Сб:</b> <?=$arProps['office_holiday']['VALUE']?></p>
					<?if (!empty($arProps['office_holiday2']['VALUE'])){?><p><b>Вс:</b> <?=$arProps['office_holiday2']['VALUE']?></p><?}?>
				</li>
				<li>
					<i class="fa fa-phone fa-lg red-style"></i>
					<p><b><?=$arProps['office_phone']['VALUE']?></b></p>
					<p><?=$arProps['office_phone2']['VALUE']?></p>
				</li>
			</ul>
<?}?>
		</div>
		<div class="col-md-7 col-xs-12">
			<div class="peopl-carusel owl-carousel">
			<?
			
			$arSelect1 = Array("ID","NAME","IBLOCK_ID","PREVIEW_PICTURE","PROPERTY_*");
		$arFilter1 = Array("IBLOCK_ID"=>7,"PROPERTY_OFFICE"=>IntVal($jobOffice));
		$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, Array("nPageSize"=>50), $arSelect1);

		$arr = array();

		while($ob = $res1->GetNextElement()){
		
		 $arFields2 = $ob->GetFields();
		
		 $arProps = $ob->GetProperties();
		 // print_r($arProps);
?>
				
				<div class="item">
					<div class="people">
						<img src="<?=CFile::GetPath($arFields2["PREVIEW_PICTURE"])?>">
						<p><b><?=$arFields2['NAME']?></b> <span><?=$arProps["POST"]["VALUE"]?></span></p>
					</div>
				</div>
		<?}?>
			</div>
		</div>
	</div>
</div>
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
    "MAP_HEIGHT" => "595",
    "CONTROLS" => array(
            
        ),
    "OPTIONS" => array(
            
            "ENABLE_DBLCLICK_ZOOM",
            "ENABLE_DRAGGING",
            "ENABLE_KEYBOARD"
        ),
    "MAP_ID" => "googlemaps"
    )
);?>
 
<div class="container-fluid footer-all" >
<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("footer_inc.php"),
			Array(),
			Array("MODE"=>"html")
		);?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>