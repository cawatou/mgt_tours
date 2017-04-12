<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");?>
<style>
body {
	background:url(/bitrix/templates/tour/images/bgr/order_bg.jpg);
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

.order {
	margin-top:100px;
}
.order h1{
	text-align:center;
	color:#fff;
	font-size:30px;
}
.overflow {
	background:rgba(255,255,255,.8);
	border-radius:5px;
	padding:40px;
	font-size:16px;
}
.anketa li{
	list-style: none;
    font-size: 13px;
    padding: 5px 0;
    float: left;
    width: 33%;
}
.anketa ul{
	padding:0;
}
.anketa {
	background:#fff;
	font-size:16px;
	padding:20px;
	border-radius:5px;
}
.anketa h4{
	font-weight:bold;
	font-size:16px;
	margin-top:0;
}
.overflow h2 {
	font-size:24px;
	font-weight:bold;
	margin-top:0;
}
.param ul li{
	float:left;
	width:50%;
}
ul:before {
    CLEAR: both;
    CONTENT: ' ';
    DISPLAY: TABLE;
}
ul:after {
    clear: both;
    content: ' ';
    DISPLAY: TABLE;
}
.anketa h2 {
	font-size:30px;
	font-weight:bold;
	margin-top:0;
}
.anketa.full {
	padding:30px;
	margin-top:30px;
}
.anketa.full h4{
	font-size:16px;
	font-weight:bold;
	margin-top:0;
}
.anketa.full label{
	font-size:13px;
	color:#999;
}
.anketa.full p{
	font-size:13px;
}
.box-price-check {
	border:3px solid #e0e0e0;
	border-radius:5px;
	padding:30px;
	color:#db3636;
	font-size:26px;
	font-weight:bold;
	background:#fff;
}
.box-price-check a:hover{
	text-decoration:none;
	color:#db3636;
}
.box-price-check div{
	
	width:50%;
	float:left;
}
.box-price-check div:last-child{
	padding-left:10px;
}
.box-price-check div:first-child{
	text-align:right;
	padding-right:10px;
}
.box-price-check a{
	font-size:13px;
	font-weight:normal;
	text-decoration:underline;
	color:#db3636;
	background:none;
}
.box-price-check:before {
    CLEAR: both;
    CONTENT: ' ';
    DISPLAY: TABLE;
}
.box-price-check:after {
    clear: both;
    content: ' ';
    DISPLAY: TABLE;
}
.doplink {
	text-align:Center;
	margin:30px 0;
}
.doplink a{
	background: #db3636;
    color: #fff;
    padding: 10px 20px;
    display: inline-block;
    border-radius: 25px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: bold;
}
li i {
	color:#db3636;
}
.newpreson label {
    font-size: 13px;
    color: #999;
}
.newpreson h4 {
    font-size: 16px;
    font-weight: bold;
    margin-top: 0;
}
.newpreson {
	padding: 30px;
    margin-top: 30px;
    background: #fff;
    font-size: 16px;
    border-radius: 5px;
}
.newpreson h1{
	font-size:30px;
	font-weight: bold;
	color: #333;
	text-align:left;
	margin-top:0;
}
.newpreson h1 span:hover{
	color:#f05252;
}
.newpreson h1 span{
	color:#db3636;
	font-size:30px;
	float:right;
	display:block;
	cursor:pointer;
}
.newpreson .dropthat{
	display:inline-block;
	background:#db3636;
	color:#fff;
	font-size:13px;
	font-weight: bold;
	line-height:44px;
	padding:0 30px;
	margin:10px 0;
	border-radius:25px;
}
.buy{
	display:inline-block;
	background:#db3636;
	color:#fff;
	font-size:16px;
	font-weight: bold;
	line-height:60px;
	padding:0 70px;
	margin:10px 0;
	border-radius:25px;
}
.laststep h4 {
	color: #fff;
    margin-top: 30px;
    font-size: 13px;
    font-weight: bold;
}
</style>

<?
define("AUTH","i@neoz.su");
define("PASS","jICPOQJ7");

$json = file_get_contents('http://tourvisor.ru/xml/actualize.php?authlogin='.AUTH.'&authpass='.PASS.'&tourid='.$_REQUEST['ID'].'&request=2&currency=0&format=json');
$arr = json_decode($json);
if(isset($_REQUEST['dev'])){
	echo "<pre>";
	var_dump($arr);
	echo "</pre>";
}
$tourinfo = file_get_contents('http://tourvisor.ru/xml/actdetail.php?authlogin=' . AUTH . '&authpass=' . PASS . '&tourid=' . $_REQUEST['ID']. '&format=json' );
$tour = json_decode($tourinfo);
if(isset($_REQUEST['dev'])){
echo "<pre>";
var_dump($tour);
echo "</pre>";
}

if(!isset($arr->data)){
	/**
	возможно это из битрикса
	проверка
	если нет то 404
	*/
}
?>
<div class="container order">
	<div class="row ">
		<div class="col-md-12">
			<?if(!isset($_REQUEST['ID'])) { echo "<h1>Вы что собрались покупать?</h1></div></div>";  } else {?><h1>Оформление заказа</h1>
		</div>
	</div>
	<div class="overflow ">
		<div class="row ">
			<div class="col-md-6">
				<h2> Стоимость тура: <?=$arr->data->tour->price; ?> Р</h2>
				<p><?=$arr->data->tour->hoteldescription; ?></p>
			</div>
			<div class="col-md-6">
				<div class="anketa param">
					<h4>Параметры тура</h4>
					<ul>
						 <?if(!empty($arr->data->tour->departurename)){?><li><i class="fa  fa-fort-awesome"></i> &nbsp;  <b>Город отправления:</b> <?=$arr->data->tour->departurename; ?></li><?}?>
						<?if(!empty($arr->data->tour->countryname)){?><li><i class="fa fa-flag"></i> &nbsp; <b>Страна:</b>  <?=$arr->data->tour->countryname; ?></li><?}?>
						<?if(!empty($arr->data->tour->hotelregionname)){?><li><i class="fa fa-map-marker"></i> &nbsp; <b>Курорт:</b> <?=$arr->data->tour->hotelregionname; ?></li><?}?>
						<?if(!empty($arr->data->tour->flydate)){?><li><i class="fa fa-calendar"></i> &nbsp; <b>Даты тура:</b> <?=$arr->data->tour->flydate; ?></li><?}?>
						<?if(!empty($arr->data->tour->nights)){?><li><i class="fa fa-calendar"></i> &nbsp; <b>Продолжительность:</b> <?=$arr->data->tour->nights; ?> ночей</li><?}?>
						<li><?if(!empty($arr->data->tour->adults)){?><i class="fa fa-user"></i> &nbsp; <b>Взрослых:</b><?=$arr->data->tour->adults; ?><?}?>  <?if(!empty($arr->data->tour->child)){?>&nbsp; <i class="fa fa-user" style="font-size:10px"></i> &nbsp;<b>Детей:</b> <?=$arr->data->tour->child; ?><?}?></li>
					</ul>
					<br style="clear:both">
				</div>
			</div>
		</div>
		<div class="anketa" style="margin-top:30px;">
			<h4>Набор услуг</h4>
			<ul>
				<?if(!empty($arr->data->tour->tourname)){?><li><i class="fa fa-plane"></i> &nbsp; <b>Тур:</b>  <?=$arr->data->tour->tourname; ?></li><?}?>
				<?if(!empty($arr->data->tour->room)){?><li><i class="fa fa-adjust"></i> &nbsp; <b>Комната:</b>  <?=$arr->data->tour->room; ?></li><?}?>
				<?if(!empty($tour->flights[0]->forward[0]->company->name)){?><li><i class="fa fa-plane"></i> &nbsp; <b>Авиакомпания:</b> <?=$tour->flights[0]->forward[0]->company->name; ?></li><?}?>
				<?if(!empty($arr->data->tour->meal)){?><li><i class="fa fa-plane"></i> &nbsp; <b>Питание:</b> <?=$arr->data->tour->meal; ?></li><?}?>
				<?if(!empty($arr->data->tour->operatorname)){?><li><i class="fa fa-star"></i> &nbsp; <b>Оператор:</b>  <?=$arr->data->tour->operatorname; ?></li><?}?>
				<?if(!empty($arr->data->tour->hotelname)){?><li><i class="fa fa-bed"></i> &nbsp; <b>Отель:</b>  <?=$arr->data->tour->hotelname; ?></li><?}?>
				<?if(!empty($arr->data->tour->flydate)){?><li><i class="fa fa-calendar"></i> &nbsp; <b>Период проживания:</b> c <?=$arr->data->tour->flydate; ?></li><?}?>
				<?if(!empty($arr->data->tour->nights)){?><li><i class="fa fa-fort-awesome"></i> &nbsp; <b>Ночей:</b>  <?=$arr->data->tour->nights; ?></li><?}?>
				<?if(!empty($arr->data->tour->placement)){?><li><i class="fa fa-bed"></i> &nbsp; <b>Размещение:</b> <?=$arr->data->tour->placement; ?></li><?}?>
				<?if(!empty($arr->data->tour->fuelcharge)){?><li><i class="fa fa-calendar"></i> &nbsp; <b>Сборы:</b>  <?=$arr->data->tour->fuelcharge; ?> Р</li><?}?>
				<?if(!empty($arr->data->tour->visacharge)){?><li><i class="fa fa-user"></i> &nbsp; <b>Виза:</b> <?=$arr->data->tour->visacharge; ?> Р</li><?}?>
			</ul>
		</div>
	</div>
	<form id="bigorder">
	<?
	
	if(!isset($_REQUEST['k'])) {
		$countz = $arr->data->tour->adults;
	}
	else {
		$countz = $_REQUEST['k'];
	}
	
	for($i=1;$i<=$countz;$i++){?>
	<div class="anketa full">
		<div class="row">
			<div class="col-md-12">
				<h2>Турист <?=$i?></h2>
			</div>
		</div>
		<div class="touristik">
		<div class="row">
			<div class="col-md-4">
				<h4>Персональная информация</h4>
				<div class="checkbox ">
					<label>
						<input type="checkbox" name="imorder[<?=$i?>]" value="Y"> Заказчик
					</label>
				</div>
				<div class="form-group ">
					<label for="sex">Пол</label>
					<select class="form-control" name="sex[]" id="sex">
						<option value="m">Мужской</option>
						<option value="w">Женский</option>
					</select>
				</div>
				<div class="form-group ">
					<label for="">Фамилия (латиницей)</label>
					<input id="" name="lastname[]" class="form-control latinz"  />
				</div>
				<div class="form-group ">
					<label for="">Имя (латиницей)</label>
					<input id="" name="firstname[]"  class="form-control latinz"  />
				</div>
				<div class="form-group ">
					<label for="">Дата рождения</label>
					<input class="form-control dtp3"  name="daybirth[]"  />
				</div>
				<div class="form-group ">
					<label for="">Гражданство</label>
					<input  class="form-control"  name="citizen[]" value="РФ" />
				</div>
			</div>
			<div class="col-md-4">
				<h4>Сведения о документах</h4>
				
				<div class="form-group ">
					<label for="">Серия и номер</label>
					<input class="form-control"  name="docsernom[]" />
				</div>
				<div class="form-group ">
					<label for="">Действителен до</label>
					<input class="form-control dtp3"  name="docbefore[]" />
				</div>
				<div class="form-group ">
					<label for="">Кем выдан документ</label>
					<textarea class="form-control"  name="docwhogive[]" rows=5></textarea>
				</div>
				
				
			</div>
			<div class="col-md-4">
				<h4>Контактная информация</h4>
				<div class="form-group ">
					<label for="">Телефон</label>
					<input class="form-control"  name="phone[]" />
				</div>
				<div class="form-group ">
					<label for="">Адрес</label>
					<input class="form-control"  name="adres[]" />
				</div>
				<div class="form-group ">
					<label for="">E-mail</label>
					<input class="form-control"  name="email[]" />
				</div>
			</div>
		</div>
		
		</div>
	</div>
	<?}?>
	<div class="row ">
		<div class=" col-md-12 doplink" >
			<a href="#" class="addchild">Добавить ребенка до 2 лет</a>
			<a href="#" class="addtourists">Добавить еще одного туриста</a>
		</div>
	</div>
	<div class="row laststep">
		<div class="col-md-4 col-md-offset-4" style="text-align:Center;margin-bottom:50px;">
			
			<h4>Стоимость тура</h4>
			<div class="box-price-check ">
				<div >
					<?=$arr->data->tour->price; ?> Р
				</div>
				<div>
					<a href="#" data-tourid="<?=$_REQUEST['ID']?>">Проверить актуальную стоимость</a>
				</div>
			</div>
			<input type="hidden" name="price" value="<?=$arr->data->tour->price; ?>">
			<input type="hidden" name="tourid" value="<?=$_REQUEST['ID']?>">
			<a href="#" class="buy saveorderform">Купить тур</a>
		</div>
	</div>
	</form>
<?}?>
</div>
<div class="container-fluid footer-all" >
<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("footer_inc.php"),
			Array(),
			Array("MODE"=>"html")
		);?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>