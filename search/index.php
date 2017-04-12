<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");


?>
<style>
body {
	background:url(/bitrix/templates/tour/images/bgr/search_bg.jpg);
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
.search {
	margin-top:110px;
}
.search-form {
	background:#fff;
	border-radius:5px;
	padding:20px;
}
.search-form h1{
	font-size:30px;
	font-weight:bold;
	margin:0 0 20px 0;
}
.overflow {
	background:rgba(255,255,255,.8);
	padding:40px;
	margin-top:30px;
	border-radius:5px;
}
.search .hotelline{
	background:#fff;
	border-radius:5px;
}

.ui-widget.ui-widget-content {
    border: none !important;
}
.ui-slider-horizontal {
    height: .3em !important;
}
.ui-widget-header {
    background: #db3636 !important;
}
.ui-slider-handle {
	border-bottom-right-radius: 50% !important;
	border-bottom-left-radius: 50% !important;
	border-top-right-radius: 50% !important;
	border-top-left-radius: 50% !important;

}
.ui-slider .ui-slider-handle {
    width: 1em !important;
    height: 1em !important;
}
.ui-widget-content {
    background: #ccc !important;
}
.ui-state-default, .ui-widget-content .ui-state-default {
    border: 4px solid #db3636 !important;
}
.breadcrumbs i{
	font-size:20px;
	margin:0 15px;
}
.breadcrumbs {
	font-size:16px;
	color:#fff;
	margin-bottom:50px;
}
.breadcrumbs a:hover{
	text-decoration:none;
	color:#fff;
}
.breadcrumbs a{
	border-bottom:2px solid #db3636;
	color:#fff;
	font-size:16px;
}
.search-form button {
	color: #fff;
    background: #db3636;
    border-radius: 10px;
    padding: 24px 146px;
    font-size: 18px;
    font-weight: bold;
    border: 0;
	    margin: 17px 10px;
}
.search-form select {
	font-size:14px;
	color:#333;
}
.search-form label {
	color:#999;
	font-size:13px;
	font-weight:normal;
}
.checkb {
	font-size:14px;
	color:#333 !important;
}
.hidecheck {
	display:none;
}
.fieldset li{ 
	margin: 5px 0 5px 20px;
	cursor:pointer;
}
.fieldset {
	list-style:none;
	border:1px solid #bfbfbf;
	border-radius:5px;
	padding:0;
	    max-height: 175px;
    overflow-y: auto;
}
.checkme {
	width:11px;
	display:inline-block;
	height:11px;
	border:1px solid #d9d9d9;
	border-radius:3px;
	margin-right:10px;
	cursor:pointer;
}
.checkeds {
    width: 11px;
    display: inline-block;
    height: 11px;
    background: #db3636;
    color: #fff;
    border-radius: 3px;
    margin-right: 10px;
    font-size: 10px;
    line-height: 11px;
    overflow: hidden;
}
.pricebox span.sel{
	    background: #db3636;
    color: #fff;
    border-radius: 5px;
}
.pricebox span{
	color: #999;
    font-size: 11px;
    line-height: 19px;
    display: table-cell;
    padding: 0 5px;
	cursor:pointer;
}
.pricebox {
	    float: right;
    line-height: 19px;
    border-radius: 5px;
    background: #e6e6e6;
    vertical-align: middle;
    display: table;
}
.hotls {
	clear:both;
}
.hotls li{
	float:left;
}
.overbtn {
	
}
.butn {
	border: 2px solid #cccccc;
    background: #fff;
    color: #db3636;
    line-height: 40px;
    display: inline-block;
    height: 40px;
    width: auto;
    text-align: center;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    min-width: 40px;
	margin-right:15px;
}
.butntx {
	border: 2px solid #cccccc;
    background: #fff;
	color: #db3636;
    line-height: 40px;
    display: inline;
    height: 40px;
    width: auto;
    text-align: center;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    min-width: 40px;
    font-weight: bold;
    text-transform: uppercase;
}
.watch {
	border-radius:25px;
	font-weight: bold;
    text-transform: uppercase;
	font-size: 14px;
	border: 2px solid #cccccc;
	background: #fff;
	color: #db3636;
	padding: 10px 20px;
	line-height: 40px;
	
}
.hotelline {
	padding:15px 0;
	margin-top:15px;
	position:relative;
	padding: 15px;
}
.hotelline h3{
	font-size:16px;
	font-weight:bold;
	text-transform:uppercase;
	margin:5px 0;
}
.hotelline .photo{
	width:175px;
	height:150px;
	overflow:hidden;
	border-radius:5px;
}
.country {
	font-size:13px;
	
}
.stars {
	color:#ffc000;
	display: inline-block;
    margin: 0;
}

.results a:hover{
	text-decoration:none;
	color:#fff;
	background:#db3636;
}
.inforesult {
	font-size:11px;
	text-align: center;
}
.votecount {
	    font-size: 16px;
    font-weight: bold;
    background: #e6e6e6;
    border-radius: 3px;
    display: inline-block;
    padding: 4px 10px;
}
.price {
	font-size: 16px;
    font-weight: bold;
    background: #db3636;
    color: #fff;
    border-radius: 3px;
    display: block;
    padding: 3px 0;
}
.getme:hover {
	background:#f38484;
	color:#fff;
	text-decoration:none;
}

.getme {
    font-size: 9px;
    font-weight: bold;
    background: #db3636;
    color: #fff !important;
    border-radius: 25px;
    text-transform: uppercase;
    float: right;
    padding: 9px 22px;
}
.hotelinfo {
	font-size:13px;
	    height: 35px;
    overflow: hidden;
}
.hotelmenu:hover {
	background:#db3636;
	color:#fff;
	text-decoration:none;
}
.hotelmenu {
    color: #db3636;
    border: 1px solid #ccc;
    border-radius: 25px;
    text-transform: uppercase;
    font-size: 9px;
    font-weight: bold;
    padding: 8px 18px;
    margin-right: 10px;
}
.gray {
	background:#f2f2f2;
}
.tr-head {
    font-size: 11px;
    color: #999;
    text-align: center;
    line-height: 45px;
    border-right: 1px solid #e6e6e6;
}
.box-prices{
	position: absolute;
    top: 173px;
    background: #fff;
    width: 100%;
    margin-left: -15px;
    z-index: 5;
	    box-shadow: -3px 11px 17px 0px rgba(0,0,0,0.4);
	display:none;
}
.tbl-prices {
	display: table;
    width: 100%;
}
.line-prices {
    padding: 20px;
	display:none;
}
.tr-price div, .th-price div{
	display:table-cell;
}
.tr-price span {
	display:block;
	line-height: normal;
}
.tr-price div {
    line-height: 55px;
    text-align: center;
	vertical-align: middle;
	height: 55px;
}
.td-oper {
	color:#6ba0ce;
}
.th-price {
	display: table-row;
    width: 100%;
}
.tr-price {
	font-size:13px;
	display: table-row;
}
.buythistour:hover {
	background:#db3636;
	color:#fff;
	text-decoration:none;
	cursor:pointer;
}
.buythistour {
    background: #ccc;
    color: #fff;
    border-radius: 50%;
    width: 30px;
    line-height: 30px;
    padding-left: 5px;
}
.footlinez{
	background:#f0f0f0;
	text-align:center;
	height:45px;
}
.footlinez .clo:hover {
	color:#db3636;
	text-decoration:none;
}

.footlinez .clo {
    float: right;
    color: #db3636;
    font-size: 25px;
    margin-right: 10px;
    font-weight: bold;
    line-height: 20px;
    margin-top: 12px;
}
.abouthotel:hover {
	text-decoration:none;
	color:#fff;
	background:#db3636;
}
.abouthotel {
    color: #db3636;
    font-weight: bold;
    text-transform: uppercase;
    border: 1px solid #ccc;
    border-radius: 25px;
    font-size: 9px;
    padding: 0px 43px;
    display: inline-block;
    line-height: 30px;
    margin-top: 7px;
}
.line-coments {
	margin-left:180px;
	padding:20px;
	display:none;
}
.green {
	color:#54c44b;
	font-size:20px;
	font-weight:bold;
}
.line-coments  a{
	text-decoration:underline;
	color:#db3636;
}
.head-info {
	font-size:13px;
}
.counter {
	color:#999;
	font-size:13px;
}
.line-coments p{
	font-size:13px;
	margin-top:10px;
	height: 33px;
    overflow: hidden;
}
.line-coments h3{
	font-weight:bold;
	margin:10px 0;
	font-size:13px;
}
span.date{
	color:#999;
	font-weight:bold;
	    font-size: 13px;
}
.vota {
	float:right;
	    font-size: 13px;
}
.line-map {
	padding-bottom:20px;
	display:none;
}
.small img{
	height:100%;
}
.small {
	width:50px;
	height:50px;
	border-radius:5px;
	overflow:hidden;
	float:left;
	margin:5px;
	cursor:pointer;
}
.line-about a{
	color:#db3636;
	text-decoration:underline;
}
.line-about {
	padding:20px;
	display:none;
}
/***** CSS Magic to Highlight Stars on Hover *****/


.starq{
	//float:left;
}
.starq:after {
	clear:both;
	content:" ";
	display:block;
}
.starq br{
	display:none;
}
.vote {
	height:43px;
}

.starq > input { display: none; } 
.starq > label:before { 
  margin: 5px;
  font-size: 2.2em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.starq > .half:before { 
  content: "\f089";
  position: absolute;
}

.starq > label { 
  color: #ddd; 
 float: right; 
 cursor:pointer;
}



.starq > input:checked ~ label, /* show gold star when clicked */
.starq:not(:checked) > label:hover, /* hover current star */
.starq:not(:checked) > label:hover ~ label { color: #ffc000;  } /* hover previous stars in list */

.starq > input:checked + label:hover, /* hover current star when changing rating */
.starq > input:checked ~ label:hover,
.starq > label:hover ~ input:checked ~ label, /* lighten current selection */
.starq > input:checked ~ label:hover ~ label { color: #FFED85;  } 

</style>
<div class="container search">
	<div class="row breadcrumbs">
		<div class="col-md-12">
			<a href="/">Главная</a> <i class="fa fa-angle-right"></i> Результаты поиска
		</div>
	</div>
	<div class="row ">
		<div class="col-md-12">
		<form id="tourvisor">
		<div class="search-form">
			<h1>Поиск туров</h1>
			<div id="searchpageidentificator"></div>
			<div class="row">
				<div class="col-md-3">
					
					<div class="form-group">
						<label>Город вылета</label>
						<select name="cityID"  class="form-control" >
							<?
								foreach($city as $key => $c){
									?><option  value="<?=$k?>"  <?if($User_city['city']==$c){?>selected<?}?>><?=$c?></option>
									<?
								}
							 ?>
						</select>
					</div>
					<div class="form-group">
						<label>Курорт  &nbsp; <input type="checkbox" name="any_curort" /> <span>Любой</span></label>
						<ul class="fieldset chkcur regionskurort"></ul>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Страна</label> 
								<select name="countryID"  class="form-control"></select>
							</div>
							<div class="form-group">
								<label>Класс отеля от</label>
								<div class="starq">						
									<input type="radio" id="53" name="hotelstar" value="5"><label for="53"> </label><br>
									<input type="radio" id="54" name="hotelstar" value="4"><label for="54"> </label><br>
									<input type="radio" id="55" name="hotelstar" value="3"><label for="55"> </label><br>
									<input type="radio" id="56" name="hotelstar" value="2"><label for="56"> </label><br>
									<input type="radio" id="57" name="hotelstar" value="1"><label for="57"> </label>	
								</div>
							</div>
							<div class="form-group">
								<label>Питание</label> 
								<select name="eats" class="form-control">
									<option value="">Любое</option>
									<?foreach($meals as $m){?>
										<option value="<?=$m['id']?>"><?=$m['russianfull']?></option>
									<?}?>
								</select>
							</div>
							<div class="form-group">
								<label>Рейтинг отеля</label> 
								<select name="raiting" class="form-control"><option value="">Любое</option><option value="1">от 1</option><option value="2">от 2</option><option value="3">от 3</option><option value="4">от 4</option><option value="5">от 5</option></select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Интервал дат вылета</label>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
  <div class="input-group " >
    <input type="text" name="fromday" class="dtp1 form-control" value="<?if(isset($_SESSION['search']['datefrom'])) echo $_SESSION['search']['datefrom']; ?>" placeholder="c" />
    <span class="input-group-addon">
      <span class="calendarico "></span>
    </span>
  </div>
</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
  <div class="input-group " >
    <input type="text" name="today" class="dtp1 form-control"  value="<?if(isset($_SESSION['search']['dateto'])) echo $_SESSION['search']['dateto']; ?>" placeholder="до" />
    <span class="input-group-addon">
      <span class="calendarico "></span>
    </span>
  </div>
</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>ночей</label>
										<input type="text" value='<?if(isset($_SESSION['search']['night_ot'])) echo $_SESSION['search']['night_ot']; else echo '7';?>' name="night_ot" class="form-control" placeholder="ночей до ">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
									<label>взрослых</label>
									 <select name="adult" class="form-control" >
									 <?for($i=1;$i<=4;$i++) {?>
									 	<option value=<?=$i?> <?if(isset($_SESSION['search']['adult'])==$i){?>selected<?}?>><?=$i?></option>
									 <?}?>
									 </select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
									<label>детей</label>
									 <select name="child" class="form-control" >
										<option value=0>выбор</option>
										<?for($i=1;$i<=4;$i++){?>
										<option value=<?=$i?> <?if(isset($_SESSION['search']['child'])==$i){?>selected<?}?>><?=$i?></option>
										<?}?>
									 </select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label>Отель</label> &nbsp; <input type="checkbox" name="hotel[]" value="any">  любой &nbsp; <input type="checkbox" name="hotel[]" value="checks"> показать отмеченные
										<input type="text" class="form-control" placeholder="Введите название отеля">
									</div>
									<div class="form-group">
										<ul class="fieldset chkcur hotelscheck">
											Выберите страну
										</ul>
									</div>
								</div>
								<div class="col-md-5 ageOfChildz">
									<?if(CSite::InGroup(array(1,10))){?>
									<div class="form-group">
										<label>Туроператор</label> &nbsp; <input type="checkbox" name="operator[]" value=""> любой
										<ul class="fieldset chkcur turoperators">
											
										</ul>
									</div>
									<?}?>
								</div>
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<label>цена</label> 
					<div class="pricebox"><span class="sel">руб</span> <span>у.е.</span></div>
					<input type="text" name="amount" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
					<div id="slider-range"></div>
					<input type="hidden" name="curency" value="0" />
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Тип отеля</label>
							<ul class="fieldset chkcur hotls">
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="" class="hidecheck"> <label>любой</label></li>
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="family" class="hidecheck"> <label>семейный</label></li>
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="active" class="hidecheck"> <label>активный</label></li>
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="city" class="hidecheck"> <label>городской</label></li>
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="deluxe" class="hidecheck"> <label>Люкс (VIP)</label></li>
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="health" class="hidecheck"> <label>здоровье</label></li>
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="relax" class="hidecheck"> <label>спокойный</label></li>
								<li><span class="checkme"></span><input type="checkbox" name="type[]" value="beach" class="hidecheck"> <label>пляжный</label></li>
							</ul>
							</div>
						</div>
						<div class="col-md-4">
							<div class="overbtn">
								<button><i class="fa fa-search"></i> Найти</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
		</div>
	</div>

	<div class="overflow" <?if(isset($_REQUEST['ID'])){?>style="display:block !important;"<?}?>>
		<div class="row results">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-4">
						<!--div class="form-group">
							<select name="sortby" class="form-control">
								<option value="price">Сортировать по цене</option>
								<option value="rait">Сортировать по рейтингу</option>
								<option value="star">Сортировать по кол-ву звезд</option>
								<option value="name">Сортировать по названию</option>
							</select>
						</div-->
					</div>
					<div class="col-md-4">
						<a href="#" class="butn"><i class="fa fa-link"></i></a>
						<a href="#" class="butn"><i class="fa fa-sort"></i></a>
						<?if(CSite::InGroup(array(1,10))){?><a href="#" class="butntx">туроператоры</a><?}?>
					</div>
					<div class="col-md-4">
						
					</div>
				</div>
			</div>
			<div class="col-md-3" style="text-align:right;">
				<a href="#" class="watch"><i class="fa fa-eye"></i> &nbsp; Следить за ценой</a>
			</div>
		</div>
		<div class="founded">
		</div>
	</div>
</div>
<div style="display:none;">
<?
$PLACEMARKS = array();
	$APPLICATION->IncludeComponent("bitrix:map.google.view",".default",array(
    "API_KEY" => "AIzaSyDVcwlJJsdy7gvq6LePrBSLE5UvPuIqrvg",
	"INIT_MAP_TYPE" => "MAP",
	"MAP_DATA" => serialize(
                  array(
                     'google_lat' => 0, // координаты центра карты
                     'google_lon' => 0, // используем координаты последнего маркера
                     'google_scale' => 10, // масштаб карты 0-20
                     'PLACEMARKS' => $PLACEMARKS // подготовленный ранее массив маркеров
                     )
               ),
    "MAP_WIDTH" => "100%",
    "MAP_HEIGHT" => "210px",
    "CONTROLS" => array( ),
    "OPTIONS" => array(
            "ENABLE_DBLCLICK_ZOOM",
            "ENABLE_DRAGGING",
            "ENABLE_KEYBOARD"
        ),
    "MAP_ID" => "googlemaps0"
    )
	);
?>
</div>

<div class="container-fluid footer-all" >
<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("footer_inc.php"),
			Array(),
			Array("MODE"=>"html")
		);?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>