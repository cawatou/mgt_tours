<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");?>
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

.overflow {
	background:rgba(255,255,255,.8);
	border-radius:5px;
	padding:40px;
}
.hotel_star {
	color:#ffc000;
	display: inline-block;
	margin: 8px 0;
    font-size: 14px;
    margin-left: 0;
}
.hotelinfos {
	margin-top:160px;
	margin-bottom:40px;
}
.hotelinfos h1{
	font-size:20px;
	font-weight:bold;
	text-transform:uppercase;
	margin: 0 0 30px 0;
}
.img {
	border-radius:5px;
	overflow:hidden;
	height: 320px;
    min-height: 320px;
}
.img img{
	height:100%;
	
}
.mini {
	opacity: .6;
    width: 22%;
    overflow: hidden;
    border-radius: 5px;
    float: left;
    cursor: pointer;
    margin: 10px 5px 10px 5px;
}
.mini.act,.mini:hover{
	opacity:1;
}
.mini img{
	
	width:100%;
}
.showmap {
    background: #db3636;
    color: #fff;
    text-transform: uppercase;
    border-radius: 25px;
    padding: 8px 33px;
    position: absolute;
    top: 160px;
    right: 30px;
    font-size: 10px;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	font-size: 16px;
    font-weight: bold;
    color: #343434;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 4px solid #db3636;
    background: transparent;
}

.nav-tabs>li>a, .nav-tabs>li>a:hover{
    color: #7b7977;
    font-weight: bold;
    font-size: 16px;
	
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 4px solid #c0bdbb;
	background:none;
}
ul.services {
	list-style:none;
	padding:0;
	font-size:16px;
	margin-top:20px;
}
.services li {
	padding:10px 0;
}
.services li .pic {
	border-radius:50%;
	background:#fff;
	padding: 25px;
    float: left;
	margin-right: 30px;
}
.infobox {
	font-size:16px;
	margin-top:20px;
}
.infobox p{
	//margin-bottom:20px;
}
.infobox a{
	color:#db3636;
	text-decoration:underline;
}
.infobox a:hover{
	text-decoration:none;
	
}
h2.rew {
	font-size:30px;
	font-weight:bold;
	color:#fff;
	text-align:center;
	padding-top:70px;
	margin:60px 0 30px 0;
}
.review {
	background:rgba(255,255,255,.8);
	border-radius:5px;
	text-align:center;
}
.review  img{
	width:100%;
}
.review .imgbox{
	width:100px;
	height:100px;
	overflow:hidden;
	border-radius:50%;
}
.review h3{
	font-size:16px;
	font-weight:bold;
}
.review span{
	font-size:10px;
}
.review i{
	color:#db3636;
}
.review p{
	line-height:22px;
	font-size:13px;
}
.rews:hover {
	color:#fff;
	text-decoration:none;
}
.rews {
	background: #db3636;
    color: #fff;
    text-transform: uppercase;
    border-radius: 25px;
    padding: 8px 33px;
	font-size:12px;
	font-weight:bold;
	    padding: 17px 54px;
		display:inline-block;
		margin: 30px 0 50px 0;
}
h3 {
	margin:0;
	font-size:16px;
	font-weight:bold;
}
.price_tur {
	color:#fff;
	background:#db3636;
	padding:5px 15px;
	border-radius:5px;
	float:right;
	font-size:20px;
	font-weight:bold;
}

.fly-from {
	background:url(/bitrix/templates/tour/images/tours_07.png) no-repeat center 9px;
	padding: 40px 0 15px 0!important;
    text-align: center;
}
.fly-to {
	background:url(/bitrix/templates/tour/images/tours_10.png) no-repeat center 9px;
	padding: 40px 0 15px 0!important;
    text-align: center;
}
.fly-to span, .fly-from span{
	
	font-size:14px;
	font-weight:bold;
	color:#666;
}
.fly-bgr {
	background:#fff;
	margin-bottom:10px;
	border-radius:5px;
}
.fly-info {
	padding-top: 16px;
}
.whiteblock {
	background:#fff;
	border-radius:5px;
	font-size:13px;
	padding:30px 17px;
	margin-top:20px;
}

.whiteblock h4{
	font-size:16px;
	font-weight:bold;
	margin-top:0;
}
.whiteblock p{
	font-size:16px;
	font-weight:bold;
}
.whiteblock span{
	color:#db3636;
	border-radius:50%;
	border:1px solid #e6e6e6;
	padding: 13px 17px;
}
.addict {
	margin:20px 0;
}
.buythistour {
	float:right;
}
.buythistour a {
    color: #fff;
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
    background: #db3636;
    display: inline-block;
    padding: 13px 27px;
    margin-left: 20px;
    border-radius: 25px;
}
.infoabouthotel {
	margin-top: 20px;
}
   
</style>
<div class="container hotelinfos">
	
	<div class="overflow">
		<div class="row ">
			<div class="col-md-12">
				<h1> Contelia Deluxe Resort 
					<img src="/images/Flags/png/spain.png" width="30">
					
				</h1>
				<div class="row ">
					<div class="col-md-4">
						<div class="img"><img src="/bitrix/templates/tour/images/bgrtour_03.png" alt="" /></div>
						
						<div class="pics">
							<div class="mini"><img src="/bitrix/templates/tour/images/bgrtour_03.png" alt="" /></div>
							<div class="mini"><img src="/bitrix/templates/tour/images/bgrtour_03.png" alt="" /></div>
							<div class="mini act"><img src="/bitrix/templates/tour/images/bgrtour_03.png" alt="" /></div>
							<div class="mini"><img src="/bitrix/templates/tour/images/bgrtour_03.png" alt="" /></div>
						</div>
					</div>
					<div class="col-md-4">
						<span class="price_tur">20 000 Р</span>
						<h3>Испания, Барселона</h3>
						
						<div class="hotel_star">
							<span class="fa fa-star yellow"></span>
							<span class="fa fa-star yellow"></span>
							<span class="fa fa-star yellow"></span>
						</div>
						<p><b>Номер тура:</b> id12345678</p>
						<p><b>Продолжительность:</b> 10 дней<br> с 15.10.2016 до 25.10.2016</p>
						<div class="row addict">
							<div class="col-md-4"><p><b>DBL2+0</b> Двухместный номер</p></div>
							<div class="col-md-4"><p><b>R0</b> Без питания</p></div>
							<div class="col-md-4"><p><b>554</b> Свободных мест в отеле</p></div>
						</div>
						
						<div class="row  fly-bgr">
							<div class="col-md-3 col-xs-3 fly-from">
								<span>Туда</span>
							</div>
							<div class="col-md-9 col-xs-9 fly-info">
					
								<div class="fly-info-block">
									<b>Вылет</b> <span>16.11.2016 в 18:00 из Москвы</span>
								</div>
								<div class="fly-info-block">
									<b>Прилет</b> <span>17.11.2016 в 18:00 из Алматы</span>
								</div>
							</div>
						</div>
						<div class="row  fly-bgr">
							<div class="col-md-3 col-xs-3 fly-to">
								<span>Обратно</span>
							</div>
							<div class="col-md-9 col-xs-9 fly-info">
					
								<div class="fly-info-block">
									<b>Вылет</b> <span>16.11.2016 в 18:00 из Москвы</span>
								</div>
								<div class="fly-info-block">
									<b>Прилет</b> <span>17.11.2016 в 18:00 из Алматы</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
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
    "MAP_HEIGHT" => "213px",
    "CONTROLS" => array(
            
        ),
    "OPTIONS" => array(
            
            "ENABLE_DBLCLICK_ZOOM",
            "ENABLE_DRAGGING",
            "ENABLE_KEYBOARD"
        ),
    "MAP_ID" => "googlemaps3"
    )
);?>
				<a href="#" class="showmap">Открыть карту</a>
			
				<div class="whiteblock">
					<h4>Погода в регионе</h4>
					<div class="row ">
						<div class="col-md-4">
							Сегодня:
							<p><span class="fa fa-thermometer-2"></span> 25 &deg;</p>
						</div>
						<div class="col-md-4">
							Завтра:
							<p><span class="fa fa-thermometer-2"></span> 23 &deg;</p>
						</div>
						<div class="col-md-4">
							Послезавтра:
							<p><span class="fa fa-thermometer-2"></span> 28 &deg;</p>
						</div>
					</div>
				</div>
			</div>
				</div>
			</div>
			
			
		</div>
		<div class="row ">
			<div class="col-md-12">
				<div class="infoabouthotel">
					<div class="buythistour">
						<a href="#">купить тур онлайн</a>
						<a href="#">отправить заявку на тур</a>
					</div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Информация об отеле</a></li>
						<li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Услуги отеля</a></li>
					</ul>
					
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane " id="home">
							<div class="infobox">
								<p><b>Сайт</b> <a href="#">www.hotel.com</a></p>
								<p><b>E-mail</b> <a href="#">info@hotel.com</a></p>
								<p><b>Телефон</b> +7 (123) 456 78 90</p>
								<p><b>Факс</b> +7 (123) 456 78 90</p>
								<p><b>Количество номеров</b> 215</p>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane active" id="profile">
							
							<div class="row ">
								<div class="col-md-6">
									<ul class="services">
										<li>
											<div class="pic"><img src="/bitrix/templates/tour/images/franshize_12.jpg"></div>
											<p><b>Услуга</b></p>
											<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
										</li>
										<li>
											<div class="pic"><img src="/bitrix/templates/tour/images/franshize_12.jpg"></div>
											<p><b>Услуга</b></p>
											<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
										</li>
										<li>
											<div class="pic"><img src="/bitrix/templates/tour/images/franshize_12.jpg"></div>
											<p><b>Услуга</b></p>
											<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
										</li>
									</ul>
								</div>
								<div class="col-md-6">
									<ul class="services">
										<li>
											<div class="pic"><img src="/bitrix/templates/tour/images/franshize_12.jpg"></div>
											<p><b>Услуга</b></p>
											<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
										</li>
										<li>
											<div class="pic"><img src="/bitrix/templates/tour/images/franshize_12.jpg"></div>
											<p><b>Услуга</b></p>
											<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
										</li>
										<li>
											<div class="pic"><img src="/bitrix/templates/tour/images/franshize_12.jpg"></div>
											<p><b>Услуга</b></p>
											<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
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