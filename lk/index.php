<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
if(!CSite::InGroup(array(1,5,10))){
	$APPLICATION->RestartBuffer();
	header("Location: /");
}
GLOBAL $cityArr,$operatorArr,$countryArr,$TVID;
?>
<style>
.hotelbasehide {
	display:none;
}
body {
	background:url(/bitrix/templates/tour/images/bgr/lk_bg.jpg);
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

.lkp {
	margin-top:100px;
	margin-bottom:40px;
}
.lkp h1{
	font-weight:bold;
	color:#fff;
	font-size:30px;
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
.overflow {
	background:rgba(255,255,255,.8);
	border-radius:5px;
	padding:25px 40px;
}
label {
	color:#808080;
	font-size:13px;
	font-weight:normal;
}
.tab-content {
	padding-top:25px;
}
input[type="submit"] {
	font-size:13px;
	font-weight:bold;
	text-transform:uppercase;
	color:#fff;
	background:#db3636;
	border-radius:25px;
	padding:11px 36px;
	display:inline-block;
	border:0;
}
.ava img{
	height:100%;
}
.ava {
	width:128px;
	height:128px;
	margin:0 auto;
	border-radius:50%;
	overflow:hidden;
}
.loadpic {
    margin: 13px 0;
    display: inline-block;
}
.redbot:hover {
	text-decoration:none;
	color: #333;
}
.redbot {
    font-size: 16px;
    font-weight: bold;
	text-transform:uppercase;
    color: #333;
    border-bottom: 2px solid #db3636;
	
}
#upload {
    bottom: 0 !important;
    top: inherit;
}

#profile ul{
	list-style:none;
	
}
#profile li{
	font-weight:bold;
	font-size:20px;
	line-height:36px;
	padding: 0 0 30px 45px;
    width: 100%;
	position:relative;
}
#profile li:before{
	border-radius:50%;
	padding:20px;
	background:#fff;
	display:inline-block;
	position: absolute;
	left: -20px;
}
#profile li.check:last-child{
	border:none;
	padding: 0 0 0 45px;
}
#profile li.check{
	border-left:2px solid #54c44b;
}
#profile li.wrong:first-child{
	padding: 30px 0 0 45px;
}
#profile li.wrong{
	border-left:2px solid #db3636;
}

#profile li.check:before{
	color:#54c44b;
	border:2px solid #54c44b;
	padding: 0 7px;
    font-size: 22px;
}
#profile li.wrong:before{
	color:#db3636;
	border:2px solid #db3636;
	font-size: 26px;
    padding: 0px 8px;
}
#profile li.disabled:before{
	color:#cccccc;
	border:2px solid #cccccc;
	content: " ";
	padding: 20px;
}
#profile li.disabled{
	font-weight:bold;
	font-size:20px;
	color:#999;
}
#mesage p {
	line-height:27px;
}
#mesage a {
	color:#fff;
	display:inline-block;
	background:#db3636;
	border-radius:25px;
	line-height:34px;
	padding: 0 34px;

}
#mesage .chatbox{
	margin-top:30px;
	background:#fff;
	border:1px solid #ccc;
	border-radius:5px;
	margin-right: -15px;
    margin-left: -15px;
}
.msg {
	background:#fff;
}
#mesage .chatlist {
	margin-right: -15px;
    margin-left: -15px;
	width:100%;
}
#mesage .chatmenu {
	line-height:40px;
	position:relative;
	border-bottom:1px solid #ccc;
}
#mesage .chatmenu i{
	    font-size: 1.4em;
		position:absolute;
		    top: 11px;
    left: 13px;
}
#mesage .chatmenu .add {
    font-size: 3em;
    position: absolute;
    top: 0;
    right: 0;
    padding: 0 10px;
    cursor: pointer;
    color: #db3636;
	border:0;
}
#mesage .chatmenu input{
	width:100%;
	padding: 0 0 0 40px;
    border: 0;
	border-right: 1px solid #ccc
}
#mesage .msg .time {
	font-size:10px;
	font-weight:bold;
}
#mesage .msg h4 {
	font-size:16px;
	margin-top:0;
	font-weight:bold;
}
#mesage .msg span {
	font-weight:bold;
	font-size:11px;
	line-height:19px;
	display:block;
}
#mesage .msg p {
	font-size:11px;
	line-height:19px;
}
#mesage .msg .col-md-2, .msg .col-md-8 {
	border-bottom: 1px solid #ccc;
}
#mesage .msg .img { width:50px; height:50px; overflow:hidden; border-radius:50%;margin:0 auto;}
#mesage .msg .img img { height:100%; }

#mesage .pict {
	    display: table-cell;
    width: 20%;
    vertical-align: middle;
}
#mesage .infomsg {
	    display: table-cell;
}
#mesage .msglines:hover{
	background:#f7f7f7;
	border-bottom:1px solid #f7f7f7;
	border-right:1px solid #f7f7f7;
}
#mesage .msglines{
	    display: table;
    padding: 20px 0;
	border-bottom:1px solid #e6e6e6;
	cursor:pointer;
	border-right: 1px solid #ccc;
	width: 100%;
}
#mesage .msgtime{
	display: table-cell;
	width: 59px;
}
.onlinechat  {
	background:#f7f7f7;
	position: relative;
	margin-right: -15px;
    margin-left: -15px;
	display:none;
}
.onlinechat .fio {
	font-weight:bold;
	font-size:16px;
}
.onlinechat .online {
	font-size:16px;
	color:#54c44b;
}
.onlinechat .small {
	width:25px;
	height:25px;
	border-radius:50%;
	display:inline-block;
	overflow:hidden;
	margin-left: 20px;
}
.chattop {
	position:relative;
	line-height:40px;
	border-bottom:1px solid #e6e6e6;
}
.searchgtn {
	    width: 50%;
    float: right;
    border: 0;
    font-size: 16px;
    padding: 0;
}
.chatline {
	display:table;
	margin-bottom:30px;
	width: 100%;
}
.chatpic {
	display:table-cell;
	width:20%;
	 vertical-align: middle;
}
.chatpic .img img {
	height:100%;
}
.chatpic .img{
	width:50px; height:50px; overflow:hidden; border-radius:50%;margin:0 auto;
	   
}
#mesage .chattext p{
	line-height:16px;
}
.chattext {
	display:table-cell;
	font-size:11px;
	line-height:16px;
}
.chatdate {
	font-size:10px;
	font-weight:bold;
	display:table-cell;
	width: 20%;
    text-align: center;
	
}
.chatbot {
	position:relative;
	padding: 20px;
}
#mesage .chatbot textarea {
	width: 100%;
    height: 80px;
    border: 1px solid #bfbfbf;
    border-radius: 10px;
    padding: 10px 54px 0 10px;
}
#mesage .chatbox a {
	text-transform: uppercase;
    padding: 0 22px;
    font-size: 10px;
    font-weight: bold;
	float:right;
	margin-top:20px;
}
.addfile {
	    cursor: pointer;
    position: absolute;
    right: 45px;
    top: 25px;
    color: #db3636;
    font-size: 2em;
}
#mesage .chatroom {
	margin: 30px 10px 0 10px;
	 height:300px;
	 overflow-y:scroll;
}
.chatroom h4{
	font-size: 11px;
    font-weight: bold;
	text-align:center;
}
.userinfo span {
	display:inline-block;
}
.userinfo {
	position:absolute;
	top:0;
	left:0;
}
.searchbtn {
	width:100%;
	border:0;
	text-align:right;
	padding-right: 40px;
	    background: #f7f7f7;
}
.redishz {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 20px;
    line-height: 40px;
    padding-right: 10px;
	color:#db3636;
}


#mesage .chatroom::-webkit-scrollbar-track
{
	//-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #e6e6e6;
}

#mesage .chatroom::-webkit-scrollbar
{
	width: 5px;
	background-color: #db3636;
}

#mesage .chatroom::-webkit-scrollbar-thumb
{
	background-color: #db3636;
	border: none;
}
#docs i:hover {
	opacity:.8;
}
#docs i {
	color:#db3636;
	font-size:2em;
	margin:0 5px;
	cursor:pointer;
}
#docs h2 {
	font-size:20px;
	font-weight:bold;
	margin:20px 0;
}
#docs table {
	background:#fff;
	border:1px solid #ccc;
	border-radius:5px;
	width:100%;
}
#docs table tr th:last-child{
	border-right:0;
}
#docs table tr th{
	font-size:13px;
	font-weight:bold;
	padding:20px 0;
	vertical-align:center;
	height:40px;
	border-bottom:1px solid #ccc;
	border-right:1px solid #ccc;
	text-align:center;
}

#docs table tr:last-child td{
	border-bottom:0;
}
#docs table tr td:last-child{
	border-right:0;
}
#docs table tr td{
	font-size:13px;
	border-bottom:1px solid #ccc;
	border-right:1px solid #ccc;
	vertical-align:center;
	height:50px;
	text-align:center;
}
#docs button {
	background: #db3636;
    color: #fff;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: bold;
    display: inline-block;
    padding: 0px 53px;
    border-radius: 25px;
    line-height: 44px;
    border: 0;
	margin:20px 0;
}
#orders .link {
	line-height:30px;
	font-size:9px;
	padding:0 10px;
	background:#db3636;
	border-radius:25px;
	text-transform:uppercase;
	color:#fff;
	display: inline-block;
}
#orders .edits {
	color:#fff;
	background:#ffba00;
	display:inline-block;
	border-radius:50%;
	
}
.trow {
	border-radius:5px;
	background:#fff;
	margin-bottom:20px;
}
.addemplcomment {
	border-radius:25px;
	border:1px solid #d9d9d9;
	color:#db3636;
}
.addemplcomment:hover {
	border-radius:25px;
	border:1px solid #db3636;
	color:#fff;
	background:#db3636;
}
table .fa-check {
	background:#01c53f;
	border-radius:50%;
	padding: 3px;
    color: #fff;
}
table .fa-repeat {
	background:#ffba00;
	border-radius:50%;
	padding: 4px;
    color: #fff;
}
table .neworder {
	background:#db3636;
	display:inline-block;
	padding:10px;
	border-radius:50%;
}
table {	
	font-size:11px;
	border-radius: 5px 5px 0 0;
}

.fulltr {
	    font-weight: bold;
    text-transform: uppercase;
    background: #fff;
    line-height: 30px;
    border-radius: 5px 5px 0 0;
	padding: 15px 15px 0 15px;
	porition:relative;
}
#orders tbody td{
	background:#fff;
}
#orders tbody tr:nth-child(2n) td:first-child{
	background:#fff;
	border-radius: 0 0 0 5px;
}
#orders tbody tr:nth-child(2n) td:last-child{
	background:#fff;
	border-radius: 0 0 5px 0;
}


.mail {
	text-decoration:underline;
	color:#db3636;
}

#vitturs h2 {
	margin-top:0;
	font-size:30px;
	font-weight:bold;
	    margin-bottom: 25px;
}
#vitturs h3 {
	margin-top:0;
	font-size:26px;
	font-weight:bold;
	    margin-bottom: 25px;
}
#vitturs h2 a:hover{
	text-decoration:none;
}
#vitturs h2 a:hover u{
	text-decoration:none;
}
#vitturs h2 a{
	color:#db3636;
	font-size:16px;
	font-weight:bold;
	margin-left:40px;
}
.lk-menu button {
	background:rgba(255,255,255,.8);
	color:#848484;
	font-size:16px;
	font-weight:bold;
	border:0;
	line-height: 40px;
    padding: 0 15px;
}
.lk-menu button.active {
	background:#fff;
	color:#db3636;
}
.lk-menu button.firstlast {
	border-radius: 5px;
	margin-right:15px;
}
.lk-menu button.first {
	border-radius:5px 0 0 5px;
}
.lk-menu button.last {
	border-radius: 0 5px 5px 0;
	margin-right:15px;
}
#vitturs .disabled{
	display:none;
}
#vitturs .save {
	color:#fff;
	background:#db3636;
}
#vitturs .undo {
	color:#db3636;
	border:1px solid #ccc;
}
.tabz  {
	padding:30px 0;
}
.tabz h4 {
	font-size:20px;
	font-weight:bold;
	margin:0 0 20px 0;
}
.tabz a.lk {
	line-height:44px;
	text-transform:uppercase;
	font-size:13px;
	font-weight:bold;
	padding:0 25px;
	display:inline-block;
	margin-right:10px;
	border-radius:25px;
}
#vitturs p {
	font-size:16px;
	font-weight:bold;
	margin-bottom:40px;
}
#vitturs p span {
	color:#fff;
	background:#db3636;
	padding:5px 10px;
	border-radius:5px;
}
.loadimg span{
	color:#db3636;
	font-size:15px;
	font-weight:bold;
	display:block;
}
.loadimg .thumb{ 
	width:100%;
}
.loadimg {
	background:rgba(255,255,255,.8);
	font-size:8em;
	border-radius:10px;
	display: block;
    text-align: center;
    padding: 20px;
    color: #dbdbdb;
	overflow:hidden;
}
a.file {
	border-bottom:2px solid #db3636;
	font-size:16px;
	font-weight:bold;
	text-transform:uppercase;
	    color: #333;
    text-decoration: none;
    padding: 0;
    line-height: inherit;
	margin-top:20px;
	border-radius:0;
}
.searchline b {
	font-size: 16px;
    display: block;
    margin-top: 20px;
}
.searchline button {
	border:0;
	background:#db3636;
	color:#fff;
	border-radius:25px;
	font-size:11px;
	font-weight:bold;
	display:block;
	line-height:35px;
	padding:0 30px;
	text-transform:uppercase;
}
.green { color:#01c53f;}
.red { color:#db3636;}
a {
	cursor:pointer;
	
}
a:hover {
	text-decoration:none;
}
a.edit {
	background: #fc0;
    padding: 0 7px;
    line-height: 25px;
    color: #fff;
	border-radius: 50%;
}
a.copy {
	background: #01c53f;
    padding: 0 6px;
    line-height: 25px;
    color: #fff;
	border-radius: 50%;
}
a.delete {
	background: #db3636;
    padding: 0 7px;
    line-height: 25px;
    color: #fff;
	border-radius: 50%;
}
.table tbody{
	background:#fff;
}
.table s, .table thead th {
	color:#999;
}
.table input {
	max-width: 100px;
    font-size: 11px;
    line-height: 1.1;
    padding: 3px 5px;
    height: 25px;
}

/**************** navigation ******************/
.navg:hover {
	color:#323232;
}
.navg {
	color:#323232;
	font-size:14px;
	background:#fff;
	border-radius:3px;
	display:inline-block;
	width:35px;
	height:35px;
	text-align:center;
	line-height: 35px;
	margin:0 10px;
}
.navg.active {
	color:#fff;
	background:#db3636;
}
.chev i{
	color:#db3636;
}
.chev:first-child {
	margin-right:30px;
}
.chev:last-child {
	margin-left:30px;
}
.chev:hover {
	color:#fff;
}
.chev {
	font-size:11px;
	font-weight:bold;
	color:#fff;
	text-transform:uppercase;
	display:inline-block;
}
.navi-bottom {
	margin-bottom:40px;
	text-align:center;
}
.activebtn{
	border: 0;
    background: #db3636;
    color: #fff;
    border-radius: 25px;
    font-size: 11px;
    font-weight: bold;
   
    line-height: 35px;
    padding: 0 30px;
    text-transform: uppercase;
}
.noactivebtn{
	    border: 1px solid #b3b3b3;
    border-radius: 25px;
    color: #db3636;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: bold;
    padding: 0 30px;
    display: inline-block;
	line-height: 35px;
}

.table-promo {
	display:table;
	width:100%;
}

.table-promo .tr{
	display:table-row;
}

.table-promo .th, .table-promo .td{
	display:table-cell;
	padding:0 10px;
}


.fulltable {
	    margin-bottom: 20px;
    box-shadow: 0px 7px 12px 0px rgba(0,0,0,.3);
    padding: 30px;
}
.bottominf {
	background: #ccc;
    text-align: right;
    line-height: 40px;
}

.bottominf span{
	color: #db3636;
    font-size: 20px;
    font-weight: bold;
    margin-right: 20px;
}

/************************end******************/
.whiteds {
	background:#fff;
	border-radius:5px;
	padding:20px;
	margin-bottom:20px;
}
span.add {
	border:1px solid #ccc;
}
.addrow, .remrow {
	cursor:pointer;
}
</style>
<div class="container lkp">
	<div class="row ">
		<div class="col-md-12">
			<h1>Личный кабинет</h1>
		</div>
	</div>
	<div class="overflow ">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" <?if(!isset($_REQUEST['ID'])){?>class="active"<?}?>><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Персональная информация</a></li>
			<?
			if(CSite::InGroup(array(10))){
				?>
				<li role="presentation" ><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Заявки и заказы</a></li>
				<li role="presentation"  <?if(isset($_REQUEST['ID'])){?>class="active"<?}?>><a href="#vitturs" aria-controls="turs" role="tab" data-toggle="tab">Витрина туров</a></li>
				<?
			} else {
				?>
				<li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Этапы брони</a></li>
				<?
			}
			?>
			
			<li role="presentation" ><a href="#mesage" aria-controls="mesage" role="tab" data-toggle="tab">Сообщения</a></li>
			<li role="presentation" ><a href="#docs" aria-controls="docs" role="tab" data-toggle="tab">Документы</a></li>
		</ul>
		<div class="tab-content">
						<div role="tabpanel" class="tab-pane <?if(!isset($_REQUEST['ID'])){?>active<?}?>" id="home">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.profile",
								"tour",
								Array(
									"SET_TITLE" => "N", 
								)
							);?>
						</div>
						<div role="tabpanel" class="tab-pane " id="orders">
<?
GLOBAL $User_city;

	$o = 0;
	if (!CModule::IncludeModule("sale")) die();
	$sale = array();
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"));
	while ($arSales = $rsSales->Fetch())
	{
		/*echo "<pre>";
		print_r($arSales);
		echo "</pre>";*/
		$sale[$o] = $arSales;
		$sale[$o]['DATE'] = strtotime($arSales['DATE_INSERT']);
		$sale[$o]['Xtype'] = 'sale';
		$o++;
	}
   
   if (!CModule::IncludeModule("form")) die(); 
$FORM_ID = 2;
$arFilter = array();
$arFields = array();
$arFields[] = array(
    "CODE"              => "questcity",       // код поля по которому фильтруем
    "VALUE"             => $User_city['city'],   // значение по которому фильтруем
    );
$arFilter["FIELDS"] = $arFields;

$rsResults = CFormResult::GetList($FORM_ID, ($by="s_timestamp"), ($order="desc"), $arFilter, $is_filtered,"Y",10);
while ($arResult = $rsResults->Fetch())
{
	CForm::GetResultAnswerArray($FORM_ID,     $arrColumns,     $arrAnswers,     $arrAnswersVarname,     array("RESULT_ID" => $arResult['ID']));
/*
echo "<pre>";
//echo "arrColumns:";
//print_r($arrColumns);
//echo "arrAnswers:";
print_r($arResult);
//print_r($arrAnswers);
//echo "arrAnswersVarname:";
//print_r($arrAnswersVarname);
echo "</pre>";
*/
?>

<?
		$sale[$o]['ID'] = $arResult['ID'];
		$sale[$o]['DATE'] = strtotime($arResult['DATE_CREATE']);
		$sale[$o]['USER_ID'] = $arResult['USER_ID'];
		$sale[$o]['USER_PHONE'] = $arrAnswersVarname[$arResult['ID']]["PHONE"][0]["USER_TEXT"];
		$sale[$o]['USER_EMAIL'] = $arrAnswersVarname[$arResult['ID']]["EMAIL"][0]["USER_TEXT"];
		$sale[$o]['THEME'] = $arrAnswersVarname[$arResult['ID']]["THEME"][0]["USER_TEXT"];
		$sale[$o]['QUESTION'] = $arrAnswersVarname[$arResult['ID']]["QUESTIONS"][0]["USER_TEXT"];
		$sale[$o]['USER_NAME'] = $arrAnswersVarname[$arResult['ID']]["NAME"][0]["USER_TEXT"];
		$sale[$o]['Xtype'] = 'quest';
		$o++;
}
?>
							<div class="row ">
								<div class="col-md-3">
									<div class="form-group ">
										<select class="form-control">
											<option>Заявки на подбор тура</option>
											<option>Заявки с данными по туру</option>
											<option>Заявки на покупку в офисе</option>
											<option>Заявки на обратный звонок</option>
											<option>Вопросы клиентов</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group ">
										<input id="kurort" class="form-control" placeholder="Найти заказ" />
										
									</div>
								</div>
								<div class="col-md-1">
										<button class="srchordtur fa fa-search"></button>
								</div>
							</div>
							<style>
								.fulltable {
									display:none;
								}
								.showmeall {
									cursor:pointer;
								}
							</style>
							<table>
								<thead>
									<tr>
										<td>Имя</td>
										<td>Почта</td>
										<td>Телефон</td>
										<td width="20%">Коментарий клиента</td>
										<td>Сотрудник</td>
										<td width="20%">Комментари сотрудника</td>
										<td>Статус</td>
										<td width="70px"></td>
									</tr>
								</thead>
								<tbody>
								<?
function array_sortz($a, $b){ 
    if ($a['DATE'] == $b['DATE']){ return 0; } 
    return ($a['DATE'] < $b['DATE']) ? -1 : 1; 
}								
usort($sale,array_sortz);
								foreach($sale as $row):?>
									<?
									$stat="";
									switch($row['STATUS_ID']){
										case 'N': $stat='<i class="fa neworder"></i> Принято(не оплачен)';break;
										case 'DN': $stat='<i class="fa fa-repeat"></i> Ожидание';break;
										case 'F': $stat='<i class="fa fa-check"></i> Обработано';break;
									}
									?>
									<tr>
										<td class="fulltr" colspan="9">
										<?if ($row['Xtype']=='podbor'){?>Заявки на подбор тура<?}?>
										<?if ($row['Xtype']=='sale'){?>Заявка с данными по туру<?}?>
										<?if ($row['Xtype']=='officeorder'){?>Заявки на покупку в офисе<?}?>
										<?if ($row['Xtype']=='backcall'){?>Заявки на обратный звонок<?}?>
										<?if ($row['Xtype']=='quest'){?>Вопросы клиентов<?}?>										
										</td>
									</tr>
									<tr class="showmeall">
										<td><?=$row['USER_NAME']?> <?=$row['USER_LAST_NAME']?></td>
										<td><a class="mail"><?=$row['USER_EMAIL']?></a></td>
										<td><?=$row['USER_PHONE']?></td>
										<td><?=$row['USER_DESCRIPTION']?></td>
										<td><?if (!empty($row['RESPONSIBLE_ID'])) {?>
											<?=$row['RESPONSIBLE_NAME']?> <?=$row['RESPONSIBLE_LAST_NAME']?>
										<?}?></td>
										<td><?if(empty($row['COMMENTS'])){?>
											<a class="add-comment order">добавить</a>
										<?}else {?>
											<?=$row['COMMENTS']?> <a class="fa fa-pencil edits"></a></td>
										<?}?>
										
										<td><?=$stat?></td>
										<td><a class="link">сохранить</a>
											
										</td>
									</tr>
									<tr>
										<td colspan=8>
											<div class="fulltable">
												<div class="row">
												<?if ($row['Xtype']=='sale'){?>
													<div class="col-md-6">
														<h3>Описание заказываемого тура</h3>
														<p><b>Туроператор:</b></p>
														<p><b>Вылет:</b></p>
														<p><b>Направление:</b></p>
														<p><b>Курорт:</b></p>
														<p><b>Отель:</b></p>
														<p><b>Ссылка:</b></p>
														<p><b>Питание:</b></p>
														<p><b>Размещение:</b></p>
														<p><b>Номер:</b></p>
														
														
													</div>
													<div class="col-md-6">
														<p><b>Дата заезда:</b></p>
														<p><b>Ночей в туре:</b></p>
														<p><b>Конечная цена:</b></p>
														<p><b>Наличие мест :</b></p>
														<p><b>Цена билетов включена:</b></p>
														<p><b>Взрослых:</b> 0</p>
														<p><b>Детей:</b> 0</p>
													
													</div>
												<?}?>
												<?if ($row['Xtype']=='officeorder'){?>
													<div class="col-md-6">
														<h3>Описание заказываемого тура в офисе</h3>
														<p>Взрослых :</p>
														<p>Детей :</p>
													</div>
												<?}?>
												<?if ($row['Xtype']=='podbor'){?>
													<div class="col-md-6">
														<h3>Подбор тура</h3>
													</div>
												<?}?>		
												<?if ($row['Xtype']=='quest'){?>
													<div class="col-md-6">
														<h3>Вопрос клиента</h3>
														<p><?=$row['QUESTION']?></p>
													</div>
													<div class="col-md-6">
														<h3>Ответ</h3>
														<label>Введите ответ</label>
														<textarea name="answer" class="">
														</textarea>
														<label>Выберите тему</label>
														<select name="questTheme">
															<option> - тема -</option>
														</select>
													</div>
												<?}?>
												</div>
												<div class="bottominf">
													<span>X</span>
												</div>
											</div>
										</td>
									</tr>
									<?endforeach;?>
									
								
								</tbody>
								
							</table>
						</div>
						<div role="tabpanel" class="tab-pane <?if(isset($_REQUEST['ID'])){?>active<?}?>" id="vitturs">
							<h2>Мой горящий тур  <a href="/" class='lk'><i class="fa fa-home"></i> &nbsp; <u>Перейти на сайт</u></a></h2>
							<p>Вы вошли как <span><i class="fa fa-user"></i> <?=$USER->GetFullName()?></span> - <?
							if (CSite::InGroup(array(1))) echo "администратор";
							else
							if (CSite::InGroup(array(10))) echo "турагент";
							?></p>
							
							<h3>Горящие туры</h3>
							<div class="lk-menu">
								<button class="action first <?if(!isset($_REQUEST['ID'])){?>active<?}?>" data-id="list" >Список</button>
								<button class="action last" data-id="addedit" ><?if(isset($_REQUEST['ID'])){?>Редактировать<?}else{?>Добавить<?}?></button>
								
								<!--button class="action firstlast" data-id="dates" >Даты обновления</button-->
								<button class="action firstlast" data-id="diskount"  >Скидки и Промо</button>
								<!--button class="action last" data-id="promo"  >Промо цена</button-->
							</div>
							
							<div class="tabz hot-list  <?if(isset($_REQUEST['ID'])){?>disabled<?}?>">
								<div class="row searchline">
									<div class="col-md-1">
										<b>Фильтр</b> 
									</div>
									<div class="col-md-3">
										<div class="form-group ">
													<label for=" ">Выберите город отправления </label>
													<input id=" " name="filter_city" class="form-control" />
												</div> 
									</div>
									<div class="col-md-3">
										<div class="form-group ">
													<label for=" ">Укажите страну </label>
													<input id=" " name="filter_country" class="form-control" />
												</div>
									</div>
									<div class="col-md-3">
										<div class="form-group ">
										<label for=" "> &nbsp;</label>
										<button>Применить</button>
										</div>
									</div>
								</div>
								<table class="table  table-striped">
									<thead> <tr> <th>Тур</th> <th>Название</th> <th>Отправление</th> <th>Страна/Курорт</th> <th>Даты</th>  <th>Цена</th> <th>Туроператор</th> <th>Статус</th> <th width=100>Сортировка</th>  <th></th> </tr> </thead>
									<tbody>
									
							<?
							$arFilter = Array("IBLOCK_ID"=>20 ,"UF_GENERATED"=>1 );
$res = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter,true, Array("ID","IBLOCK_ID","ACTIVE","SORT","PICTURE","NAME","UF_DEPARTURE"));
while ($resr = $res->GetNext()) {
	
	
	$arSelect = Array("ID","IBLOCK_ID","ACTIVE","SORT","TIMESTAMP_X","NAME","PREVIEW_PICTURE","PROPERTY_COUNTRY","PROPERTY_PRICE","PROPERTY_PRICEDISCOUNT","PROPERTY_CURORT","PROPERTY_DAYCOUNT","PROPERTY_TUROPERATOR","PROPERTY_DATEFROM","PROPERTY_DATETO","PROPERTY_DEPARTURE");
$arFilter2 = Array("IBLOCK_ID"=>20,  "IBLOCK_SECTION_ID"=>$resr['ID']);
$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res2->GetNextElement()){
 $arFields = $ob->GetFields();  
/*
 echo "<pre>";
	var_dump($arFields);
	echo "</pre>";
 $arProps = $ob->GetProperties();
echo "<pre>";
	var_dump($arProps);
	echo "</pre>";
	*/
}

			?>			
	<tr> 
						<th scope="row"><?=$resr['ID']?></th> 
						<td><?=$resr['NAME']?></td> 
						<td>из <?=$arFields['PROPERTY_DEPARTURE_VALUE']?></td> 
						<td><?=$arFields['PROPERTY_COUNTRY_VALUE']?>/<?=$arFields['PROPERTY_CURORT_VALUE']?></td>  
						<td><?=$arFields['PROPERTY_DATEFROM_VALUE']?>,<br> <?=$arFields['PROPERTY_DATETO_VALUE']?></td> 
						<td><s><?=$arFields['PROPERTY_PRICE_VALUE']?></s><br> <?=$arFields['PROPERTY_PRICEDISCOUNT_VALUE']?></td> 
						<td> </td> 
						<td><?if($resr['ACTIVE']=='Y'){?><span class="green">Показывать</span><?}else{?><span class="red">Скрывать</span><?}?></td> 
						<td><div class="form-group ">
							<input  name="sortindex" class="form-control" data-id="<?=$resr['ID']?>" value="<?=$resr['SORT']?>"/>
							</div></td> 
						<td><a class="edit fa fa-pencil" data-id="<?=$resr['ID']?>"></a> <a class="copy fa  fa-copy" data-id="<?=$resr['ID']?>"></a> <a class="delete fa  fa-trash-o" data-id="<?=$resr['ID']?>"></a></td>
					</tr> 
<?
}?>
									  </tbody>
								</table>
								
								<div class="row">
									<div class="col-md-12 col-xs-12 navi-bottom">
										<!--a class="chev" href=""><i class="fa  fa-chevron-left "></i> предыдущая</a-->
										<a class="navg active" href="#">1</a>
										<!--a class="navg" href="#">2</a>
										<a class="navg ">3</a-->
										<!--a class="chev" href="/content/companion/?PAGEN_1=2">следующая <i class="fa  fa-chevron-right "></i></a-->
									</div>
								</div>
								
							</div>
							
							<div class="tabz hot-addedit <?if(!isset($_REQUEST['ID'])){?>disabled<?}?>">
								<form action="post" id="touradd">
								<?if(isset($_REQUEST['ID'])):?>
									<input type="hidden" name="id" value="<?=$_REQUEST['ID']?>" /><?


$arFilter = Array("ID"=>$_REQUEST['ID'],"IBLOCK_ID"=>20 );
$res = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter,true, Array("ID","IBLOCK_ID","ACTIVE","PICTURE","NAME","UF_DEPARTURE"));
$turs = $res->GetNext();


	
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>20,  "IBLOCK_SECTION_ID"=>$turs['ID']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()){
 $arFieldz[] = $ob->GetFields();

 $arProps[] = $ob->GetProperties();
 /*
echo "<pre>";
	var_dump($turs);
	echo "</pre>";*/
/*echo "<pre>";
	var_dump($arProps);
	echo "</pre>";*/
	
}
								 endif;?>
								
								
								<div class="row">
									<div class="col-md-4">
										 <div class="form-group ">
											<label for=" ">Обложка </label>
											<input type="file" id=" " name="cover" class="form-control" />
										</div>
										<? if(isset($_REQUEST['ID'])) {?>
										<div class="row">
									<div class="col-md-6">
									 <div class="form-group ">
											<label for=" ">Цена мин.</label>
											<input type="text" id=" " name="p" value="<?=$arProps[0]['MIN_PRICE']['VALUE']?>" disabled class="form-control" />
										</div>
									</div>
									<div class="col-md-6">
									 <div class="form-group ">
											<label for=" ">Цена мин.старая</label>
											<input type="text" id=" " name="p1" value="<?=$arProps[0]['PRICEOLD']['VALUE']?>" disabled class="form-control" />
										</div>
									</div>
									</div>
										<?}?>
										<div class="form-group ">
											<label for=" ">Отправление </label>
											<select name="cityz" class="form-control" <?if(isset($_REQUEST['ID'])){?>data-editid="<?=$arProps[0]['DEPARTURE']['VALUE']?>"<?}?>>
											
											</select>
											<input type="hidden" name="tvid" value="<?if(isset($_REQUEST['ID'])){?><?=$turs['UF_DEPARTURE']?><?}else{?>0<?}?>">
										</div>
										<div class="form-group ">
											<label for=" ">Страна</label>
											<select name="countryz" class="form-control" <?if(isset($_REQUEST['ID'])){?>data-editid="<?=$arProps[0]['COUNTRY']['VALUE']?>"<?}?>>
											
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="pict">
										<?if(isset($_REQUEST['ID'])){?>
											<?if (!empty($turs["PICTURE"])){?><img src="<?=CFile::GetPath($turs["PICTURE"]) ?>" width="100%"><?}?>
										<?}?>
										</div>
									</div>
								</div>
								
										<div class="row">
											<div class="col-md-4">	
												<div class="form-group ">
													<label for=" ">Курорт</label>
													<select name="curort" class="form-control" <?if(isset($_REQUEST['ID'])){?>data-editid="<?=$arProps[0]['CURORT']['VALUE']?>"<?}?>>
													
													</select>
												</div>
											</div>
											<div class="col-md-4 hiddenifneed">	
												<div class="form-group ">
													<label for=" ">Направление/область</label>
													<input id=" " name="curort_new" value="<?if(isset($_REQUEST['ID'])){?><?=$arProps[0]['CURORT']['VALUE']?><?}?>"  class="form-control" />
												</div>
											</div>
										</div>
							
								<div class="row">
									<div class="col-md-12 appendtome">
									
									<?
									
									if($arFieldz==NULL) {
										$arFieldz[] = array();
									}
									$z=1;
									foreach ($arFieldz as $key=> $row) {
										
										if(isset($row['ID'])) {
											?><input type="hidden" name="tour_id[]" value="<?=$row['ID']?>"><?
											
										}
									?>
									
										<div class="hotBaseAndDate" data-rid="<?if(isset($row['ID']))echo $row['ID']; else echo '1';?>">
											<div class="whiteds">
												<h4>Дата вылета #<b><?if(isset($row['ID']))echo $row['ID']; else echo '1';?></b> <span style="float:right;display:inline-block;"><label><input type="checkbox" name="dates[<?=$z;?>][turhide]" class="copyme"> Показывать</label></span></h4>
												<div class="row">
													<div class="col-md-2">
														<div class="form-group ">
															<label for=" ">Туроператор </label>
															<select name="dates[<?=$z;?>][turoper]" class="form-control turopers copyme" <?if(isset($_REQUEST['ID'])){?>data-editid="<?=$arProps[$key]['TUROPERATOR']['VALUE']?>"<?}?>>
															</select>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group ">
															<label for=" ">Дата вылета</label>
															<input id=" " name="dates[<?=$z;?>][date_from]" value="<?=$arProps[$key]['DATEFROM']['VALUE']?>" class="dtp2 form-control fromdatewl copyme" />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group ">
															<label for=" ">Дата прилета</label>
															<input id=" " name="dates[<?=$z;?>][date_to]" value="<?=$arProps[$key]["DATETO"]['VALUE']?>" class="dtp2 form-control copyme" />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group ">
															<label for=" ">Кол-во дней</label>
															<input id=" " name="dates[<?=$z;?>][nights]" value="<?=$arProps[$key]['DAYCOUNT']['VALUE']?>"  class="form-control copyme" />
														</div>
													</div>
													<div class="col-md-2">
														<a class="edit fa fa-pencil" data-id="389"></a>
														<a class="copy fa  fa-copy" data-id="389"></a> 
														<a class="delete fa  fa-trash-o" data-id="389"></a>
													</div>
												</div>
										<div class="hotelbasehide">		
												<?
if($row['ID']!=NULL){
	$arFields3 = array();
	$arProps3 = array();
	$arSelect3 = Array("ID","IBLOCK_ID","IBLOCK_SECTION_ID","NAME","PREVIEW_PICTURE");
	$arFilter3 = Array("IBLOCK_ID"=>23,  "PROPERTY_TOURIDBX"=>$row['ID']);
	$res3 = CIBlockElement::GetList(Array("PROPERTY_price" => "ASC"), $arFilter3, false, Array("nPageSize"=>50), $arSelect3);
	while($ob = $res3->GetNextElement()){
	 $arFields3[] = $ob->GetFields();
		
	 $arProps3[] = $ob->GetProperties();
	/*echo "<pre>";*
		var_dump($arProps3);
		echo "</pre>";*/
	}
}
else {
	$arFields3[]= array();
}


	?>
												<div class="row">
										<div class="col-md-12">
											
											<h4>Отельная база</h4>
											<span>Отельная база автоматически сортируется по стоимости первой даты вылета, за искючением первых двух строк</span>
											<div class="row">
												<div class="col-md-1">
													<div class="form-group ">
														<label for=" ">#</label>
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group ">
														<label for=" ">Название отеля</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group ">
														<label for=" ">Класс</label>
													</div>
												</div>
												<div class="col-md-2">
												
													<div class="form-group ">
														<label for=" ">Питание</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group ">
														<label for=" " class="dataDeparture">Стоимость</label>
													</div>
												</div>
												<div class="col-md-1">
												</div>
												<div class="col-md-1">
												</div>
											</div>
											
											<?$k=1;
											foreach($arFields3 as $key1 =>$row2){?>
											<?
											if(isset($row2['ID'])) {
											?><input type="hidden" name="hotel_id[]" value="<?=$row2['ID']?>" />
											<input type="hidden" name="section_id[]" value="<?=$row2['IBLOCK_SECTION_ID']?>" />

										<?}?>
											<div class="row">
												<div class="col-md-1">
													<div class="p-p"><?=$k?></div>
													<input type="hidden" name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][sort]" value="<?=$k?>" class="form-control sorthotel copyme">
												</div>
												
												<div class="col-md-3">
													<div class="form-group ">
														
														<input name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][hotid]" type="hidden"  class="form-control hotelzid copyme" value="<?=$arProps3[$key1]['hotelcode']['VALUE']?>"/>
														<input name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][name]" value="<?=$row2['NAME']?>" class="form-control hotelzname copyme" />
														<?if(!empty($arProps3[$key1]['LINK']['VALUE'])){?>
															<div class="form-group urladr"><label for=" ">УРЛ отеля</label><input name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][urladr]" value="<?=$arProps3[$key1]['LINK']['VALUE']?>" placeholder="http:// отеля" class="form-control"></div>
														<?}?>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group ">
														<select name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][stars]"  class="form-control copyme">
														
															<option value="5" <?if($arProps3[$key1]['hotelstars']['VALUE']==5){?>selected<?}?>>★★★★★</option>
															<option value="4" <?if($arProps3[$key1]['hotelstars']['VALUE']==4){?>selected<?}?>>★★★★</option>
															<option value="3" <?if($arProps3[$key1]['hotelstars']['VALUE']==3){?>selected<?}?>>★★★</option>
															<option value="2" <?if($arProps3[$key1]['hotelstars']['VALUE']==2){?>selected<?}?>>★★</option>
															<option value="1" <?if($arProps3[$key1]['hotelstars']['VALUE']==1){?>selected<?}?>>★</option>
															<option value="6" <?if($arProps3[$key1]['hotelstars']['VALUE']==6){?>selected<?}?>>HV-1</option>
															<option value="7" <?if($arProps3[$key1]['hotelstars']['VALUE']==7){?>selected<?}?>>HV-2</option>
														</select>
													</div>
												</div>
												<div class="col-md-2">
												
													<div class="form-group ">
														<select name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][meals]"  class="form-control copyme">
														<?foreach($meals as $m){?>
															<option value="<?=$m['id']?>" <?if($arProps3[$key1]['meal']['VALUE']==$m['id']){?>selected<?}?>><?=$m['name']?></option>
															<?}?>
														</select>
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group ">
													
														<input id=" " name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][price]" value="<?=$arProps3[$key1]['price']['VALUE']?>" class="form-control copyme" />
													</div>
												</div>
												<div class="col-md-1">
													<div class="form-group ">
														<div class="checkbox ">	
											<label><input type="checkbox" name="dates[<?=$z;?>][hotel_base][<?=$k-1;?>][promo]" value="Y" <?if($arProps3[$key1]['PROMO']['VALUE']=="Y"){?>checked<?}?> class="copyme"> промо</label>
														</div>
													</div>
												</div>
												
												<div class="col-md-1">
													<div class="form-group">
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="product_edit__product_departure_hotels_0" data-toggle="dropdown">
							<i class="fa fa-bars"></i>
						</button>

						<ul class="dropdown-menu pull-right" aria-labelledby="product_edit__product_departure_hotels_0">
							<li>
								<a href="#" class="add-row" data-then="before">
									<i class="fa fa-plus"></i>
									Добавить выше
								</a>
							</li>
							<li>
								<a href="#" class="add-row" data-then="after">
									<i class="fa fa-plus"></i>
									Добавить ниже
								</a>
							</li>
							

							<li>
								<a href="#" class="up-row">
									<i class="fa fa-arrow-up"></i>
									Вверх
								</a>
							</li>

							<li>
								<a href="#" class="down-row">
									<i class="fa fa-arrow-down"></i>
									Вниз
								</a>
							</li>

							<li>
								<a href="#" class="del-row">
									<i class="fa fa-times"></i>
									Удалить
								</a>
							</li>
						</ul>
					</div>
				</div>
												</div>
											</div>
											<?$k++;}?>
											
										</div>
									</div>
												<div class="checkbox nodiscount">	
													<label><input type="checkbox" name="dates[<?=$z;?>][autoDiscount]" class="copyme"> Без скидки <a href="#" class="thatisit">?</a></label>
												</div>
												<div class="checkbox promos">	
													<label><input type="checkbox" name="dates[<?=$z;?>][promoPrice]" class="copyme"> <span>Промо цена</span></label>
												</div>
											
											
											
											<?
if(isset($_REQUEST['ID'])) {
	$arrInc = array();
	$ids = array();
	if(!empty($arProps[$key]['DOPS']['VALUE'])) {
		$arProps[$key]['DOPS']['VALUE'] = substr($arProps[$key]['DOPS']['VALUE'], 0, -1);
		$ids = explode(",",$arProps[$key]['DOPS']['VALUE']);
	}
	if(!empty($arProps[$key]['INPRICE']['VALUE'])) {
		$arProps[$key]['INPRICE']['VALUE'] = substr($arProps[$key]['INPRICE']['VALUE'], 0, -1);
		$ids = array_merge($ids,explode(",",$arProps[$key]['INPRICE']['VALUE']));
	}
}
	
		
		$arFields3 = array();
		$arProps3 = array();
		$arSelect3 = Array("ID","IBLOCK_ID","IBLOCK_SECTION_ID","NAME");
		$arFilter3 = Array("IBLOCK_ID"=>28);
		$res3 = CIBlockElement::GetList(Array(), $arFilter3, false, Array("nPageSize"=>50), $arSelect3);
		
		while($ob = $res3->GetNextElement()){
			$arFields3 = $ob->GetFields();
			$arrInc[] = array( "value" => $arFields3["NAME"], "id" => $arFields3["ID"], "blockid" => $arFields3["IBLOCK_SECTION_ID"]);     

		}

?>
								<div class="row">
									<div class="col-md-6">
										<div class="whiteds">
											<h4>В стоимость входит</h4>
											<?if(isset($_REQUEST['ID'])){
												
												foreach($ids as $k){
													
												?>
											
											<div class="form-group ">
												<div class="input-group ">
													<input type="hidden" name="dates[<?=$z;?>][incldopsid][]" value="<?=$k?>"   class="copyme" />
													<select name="dates[<?=$z;?>][incldops][]"  class="copyme form-control" />
														<?foreach($arrInc as $incl){
															if($incl['blockid']=='393'){
															?>
														<option value="<?=$k?>" <?if($incl['id']==$k){?>selected<?}?>><?=$incl['value']?></option>
															<?}
														}?>
													</select>
													<div class="input-group-addon remrow">X</div> 
												</div>
											</div>
												<?}?>
											<?}?>
											<div class="form-group ">
												<div class="input-group ">
													<input type="hidden" name="dates[<?=$z;?>][incldopsid][]"  class="copyme" />
													<select name="dates[<?=$z;?>][incldops][]"  class="copyme form-control" >
														<option value="0">Выбрать</option>
														<?foreach($arrInc as $incl){
															if($incl['blockid']=='393'){
															?>
														<option value="<?=$incl['id']?>"><?=$incl['value']?></option>
															<?}
														}?>
													</select>
													<div class="input-group-addon addrow">+</div> 
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="whiteds">
											<h4>Оплачивается отдельно</h4>
											<?if(isset($_REQUEST['ID'])){
												foreach($ids as $k){
													
												?>
											<div class="form-group ">
												<div class="input-group ">
													
													<input type="hidden" name="dates[<?=$z;?>][paydopid][]" value="<?=$k?>" class="copyme"  />
													<select name="dates[<?=$z;?>][paydop][]" class="copyme  form-control" />
													<?foreach($arrInc as $incl){
															if($incl['blockid']=='394'){
															?>
														<option value="<?=$k?>" <?if($incl['id']==$k){?>selected<?}?>><?=$incl['value']?></option>
															<?}
														}?>
													</select>
													<div class="input-group-addon remrow">X</div>
												</div>
											</div>
												<?}?>
											<?}?>
											<div class="form-group ">
												<div class="input-group ">
													
													<input type="hidden" name="dates[<?=$z;?>][paydopid][]" value=""  class="copyme" />
													<select name="dates[<?=$z;?>][paydop][]" class="copyme  form-control" />
													<option value="0">Выбрать</option>
													<?foreach($arrInc as $incl){
															if($incl['blockid']=='394'){
															?>
														<option value="<?=$$incl['id']?>" ><?=$incl['value']?></option>
															<?}
														}?>
													</select>
													<div class="input-group-addon addrow">+</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
	
										<div class="row">
									<div class="col-md-12">
									<div class="form-group ">
											<label for=" ">Документы,визы</label>
											<!--textarea name= class="form-control notepad copyme" rows=6></textarea-->
											
											<?$APPLICATION->IncludeComponent("bitrix:fileman.light_editor","",Array(
    "CONTENT" => $arProps[$key]['DOCUMS']['VALUE'],
    "INPUT_NAME" => "dates[".$z."][document]",
    "INPUT_ID" => "",
    "WIDTH" => "100%",
    "HEIGHT" => "100px",
    "RESIZABLE" => "Y",
    "AUTO_RESIZE" => "Y",
    "VIDEO_ALLOW_VIDEO" => "Y",
    "VIDEO_MAX_WIDTH" => "640",
    "VIDEO_MAX_HEIGHT" => "480",
    "VIDEO_BUFFER" => "20",
    "VIDEO_LOGO" => "",
    "VIDEO_WMODE" => "transparent",
    "VIDEO_WINDOWLESS" => "Y",
    "VIDEO_SKIN" => "/bitrix/components/bitrix/player/mediaplayer/skins/bitrix.swf",
    "USE_FILE_DIALOGS" => "Y",
    "ID" => "",	
    "JS_OBJ_NAME" => ""
    )
);?>
										</div>
										</div>
										</div>
									
											</div>
											</div>
										</div>
									<?$z++;
									}?>
									</div>
								</div>
								<b>Статус</b>
								<div class="checkbox ">	
									<label><input type="radio" name="show" <?if(!isset($_REQUEST['ID'])||$turs['ACTIVE']=='Y'){?>checked<?}?> value='1'>Показывать</label>
								</div>
								<div class="checkbox ">	
									<label><input type="radio" name="show"  <?if(isset($resr['ACTIVE'])&&$turs['ACTIVE']=='N'){?>checked<?}?> value='0'>Скрывать</label>
								</div>
								<button type="submit" class="activebtn"><?if(isset($_REQUEST['ID'])){?>внести изменения<?}else{?>Добавить<?}?></button>
								<button type="reset" class="noactivebtn" onclick="window.history.back();">Отмена</button>
								</form>
								
							</div>
							<div class="tabz hot-dates disabled">
							
							</div>
							<div class="tabz hot-diskount disabled">
							<?
$arFilter = Array("ID"=>307,"IBLOCK_ID"=>25 );
$res = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter,true, Array("ID","IBLOCK_ID","ACTIVE","NAME","UF_DEFAULTPROMO"));
$discn = $res->GetNext();
$arFilter = Array("ID"=>308,"IBLOCK_ID"=>25 );
$res = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter,true, Array("ID","IBLOCK_ID","ACTIVE","NAME","UF_DEFAULTPROMO"));
$pdiscn = $res->GetNext();
?>
								<form id="discounts">
								<div class="row">
									<div class="col-md-3 col-xs-6">
										<div class="form-group ">
											<label>Скидка по умолчанию</label>
											<input id=" " name="dscntDef" value="<?=$discn['UF_DEFAULTPROMO'] ?>" class="form-control" />
										</div>
									</div>
									<div class="col-md-3 col-xs-6">
										<div class="form-group ">
											<label>ПромоСкидка по умолчанию</label>
											<input id=" " name="promoDef" value="<?=$pdiscn['UF_DEFAULTPROMO'] ?>" class="form-control" />
										</div>
									</div>
								</div>
								<?
								$k=0;
								$arProps = array();
								$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>25);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()){
 $discounts[] = $ob->GetFields();

 $arProps[] = $ob->GetProperties();
}

if($discounts==NULL) {
	$discounts[] = array();
}
								?>
								<div class="table-promo">
									<div class="tr">
										<div class="th">
											Промо
										</div>
										<div class="th">
											Страна
										</div>
										<div class="th">
											Туроператор
										</div>
										<div class="th">
											Город вылета
										</div>
										<div class="th">
											Цена, мин
										</div>
										<div class="th">
											Цена, макс
										</div>
										<div class="th">
											Скидка
										</div>
										<div class="th">
											
										</div>
									</div>
									<? foreach ($discounts as $d):?>
									<div class="tr" data-rowid="<?=$d['ID'] ?>">
										<?
										
										//var_dump($arProps[$k]);
										?>
									<?if(isset($d['ID'])){?><input type="hidden" name="discountId[<?=$k?>]" value="<?=$d['ID'] ?>" /><?}?>
										<div class="td" style="width:50px">
											<div class="checkbox"><label><input type="checkbox" name="promo[0]" value="1" <?if($arProps[$k]["PROMO"]["VALUE"]=="Y"){?>checked<?}?> /></label></div>
										</div>
										<div class="td" style="width:16%">
											<div class="form-group ">
												<select name="country[]" class="form-control">
													<option value="0">&nbsp;</option>
													<?foreach($countryArr->lists->countries->country as $c){?>
													<option value="<?=$c->name?>" <?if($arProps[$k]['COUNTRY']['VALUE']==$c->name){?>selected<?}?>><?=$c->name?></option>
													<?}?>
												</select>
											</div>
										</div>
										<div class="td" style="width:16%">
											<div class="form-group "><select name="operator[]" class="form-control">
											<option value="0">&nbsp;</option>
											<?foreach($operatorArr->lists->operators->operator as $c){?>
											<option value="<?=$c->russian?>" <?if($arProps[$k]['TUROPERATOR']['VALUE']==$c->russian){?>selected<?}?>><?=$c->russian?></option>
											<?}?>
											</select></div>
										</div>
										<div class="td" style="width:16%">
											<div class="form-group "><select name="departure[]" class="form-control">
											<option value="0">&nbsp;</option>
											<?foreach($cityArr->lists->departures->departure as $c){?>
											<option value="<?=$c->name?>" <?if($arProps[$k]['CITY']['VALUE']==$c->name){?>selected<?}?>><?=$c->name?></option>
											<?}?>
											</select></div>
										</div>
										<div class="td">
											<div class="form-group "><input name="price_min[]" value="<?=$arProps[$k]['MIN_PRICE']['VALUE']?>" class="form-control" /></div>
										</div>
										<div class="td">
											<div class="form-group "><input name="price_max[]" value="<?=$arProps[$k]['MAX_PRICE']['VALUE']?>" class="form-control" /></div>
										</div>
										<div class="td" >
											<div class="form-group "><input name="discount[]" value="<?=$arProps[$k]['DISCOUNT']['VALUE']?>" class="form-control" /></div>
										</div>
										<div class="td">
											<div class="form-group">
												

												<div class="dropdown">
													<button class="btn btn-default dropdown-toggle" type="button" id="discounts_" data-toggle="dropdown">
														<i class="fa fa-bars"></i>
													</button>

													<ul class="dropdown-menu pull-right" aria-labelledby="discounts_">
														
														<li>
								<a href="#" class="add-row" data-then="before">
									<i class="fa fa-plus"></i>
									Добавить выше
								</a>
							</li>
							<li>
								<a href="#" class="add-row" data-then="after">
									<i class="fa fa-plus"></i>
									Добавить ниже
								</a>
							</li>
														<li>
															<a href="#" class="del-row">
																<i class="fa fa-times"></i>
																Удалить
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<?$k++;?>
									<?endforeach;?>
								</div>
								<input type="submit" value="внести изменения">
								</form>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane " id="profile">
							<?
							if (!CModule::IncludeModule("sale")) die();
$sale = array();
	$rsSales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"),array("USER_ID" => $USER->GetID()));
	while ($arSales = $rsSales->Fetch())
   {
	  echo "<pre>";
      print_r($arSales);
      echo "</pre>";
   }
   if(!empty($arSales)){
							?>
							<ul>
							
								<li class="<?if ($arSales[0]['STATUS_ID']!="N"){?>check<?}else{?>wrong<?}?> fa fa-check">Внесение оплаты / предоплаты </li>
								<li class="<?if ($arSales[0]['STATUS_ID']!="N"){?>check<?}else{?>wrong<?}?> fa fa-check">Бронирование тура </li>
								<li class="<?if ($arSales[0]['STATUS_ID']!="N"){?>check<?}else{?>wrong<?}?> fa fa-check">Присвоение туроператором конкретного номера для брони </li>
								<li class="<?if ($arSales[0]['STATUS_ID']!="N"){?>check<?}else{?>wrong<?}?> fa fa-check">Подтверждение/не подтверждение отеля </li>
								<li class="<?if ($arSales[0]['STATUS_ID']!="N"){?>disabled<?}else{?>wrong<?}?>  fa fa-remove">Подтверждение/не подтверждение отеля </li>
								<li class="disabled">Доплата /аннуляция </li>
								<li class="disabled">Оплата туроператору </li>
								<li class="disabled">Выдача документов </li>
								<li class="disabled">Оповещение о времени вылета </li>
								<li class="disabled">Рейс (обратно) </li>
							
							</ul>
   <?}else {
	   ?><b>вы не делали заказов</b><?
   }?>
						</div>
						<div role="tabpanel" class="tab-pane " id="mesage">
							<div class="row ">
								<div class="col-md-8">
									<p> Повседневная практика показывает, что новая модель организационной деятельности в значительной степени обуславливает создание позиций, занимаемых участниками в отношении поставленных задач. Не следует, однако забывать, что новая модель организационной деятельности способствует подготовки и реализации систем массового.</p>
								</div>
							</div>
							<a href="#" data-toggle="modal" data-target="#question">Задать вопрос</a>
							<div class="chatbox">
								<div class="row row-flex row-flex-wrap ">
									<div class="col-md-6">
										<div class="chatlist">
											<div class="chatmenu">
												<i class="fa fa-search redish"></i>
												<input type="text" placeholder="Поиск среди сообщений" >
												<span class="add" data-toggle="modal" data-target="#question">+</span>
											</div>
											<div class="msg ">
											<?
if(!CModule::IncludeModule("form")) die();
$FORM_ID = 2;

// фильтр по полям результата
$arFilter = array(
/*
    "ID"                   => "2",              // ID результата
    "ID_EXACT_MATCH"       => "N",               // вхождение
    "STATUS_ID"            => "9 | 10",          // статус
    "TIMESTAMP_1"          => "10.10.2003",      // изменен "с"
    "TIMESTAMP_2"          => "15.10.2003",      // изменен "до"
    "DATE_CREATE_1"        => "10.10.2003",      // создан "с"
    "DATE_CREATE_2"        => "12.10.2003",      // создан "до"
    "REGISTERED"           => "Y",               // был зарегистрирован
    "USER_AUTH"            => "N",               // не был авторизован
    "USER_ID"              => "45 | 35",         // пользователь-автор
    "USER_ID_EXACT_MATCH"  => "Y",               // точное совпадение
    "GUEST_ID"             => "4456 | 7768",     // посетитель-автор
    "SESSION_ID"           => "456456 | 778768", // сессия
	*/
    );

// фильтр по вопросам
$arFields = array();
/*
$arFields[] = array(
    "CODE"              => "questcity",       // код поля по которому фильтруем
    "VALUE"             => $arGame["ID"],   // значение по которому фильтруем
    );

$arFields[] = array(
    "CODE"              => "GAME_NAME",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по числовому полю
    "PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
    "VALUE"             => "Tetris",        // значение по которому фильтруем
    "EXACT_MATCH"       => "Y"              // ищем точное совпадение
    );

$arFields[] = array(
    "CODE"              => "GENRE_ID",      // код поля по которому фильтруем
    "FILTER_TYPE"       => "integer",       // фильтруем по числовому полю
    "PARAMETER_NAME"    => "ANSWER_VALUE",  // фильтруем по параметру ANSWER_VALUE
    "VALUE"             => "3",             // значение по которому фильтруем
    "PART"              => 1                // с
    );

$arFields[] = array(
    "CODE"              => "GENRE_ID",      // код поля по которому фильтруем
    "FILTER_TYPE"       => "integer",       // фильтруем по числовому полю
    "PARAMETER_NAME"    => "ANSWER_VALUE",  // фильтруем по параметру ANSWER_VALUE
    "VALUE"             => "6",             // значение по которому фильтруем
    "PART"              => 2                // по
    );

$arFilter["FIELDS"] = $arFields;
*/
// выберем первые 10 результатов
$rsResults = CFormResult::GetList($FORM_ID, ($by="s_timestamp"), ($order="desc"), $arFilter, $is_filtered,"Y",10);
while ($arResult = $rsResults->Fetch())
{
    //echo "<pre>"; print_r($arResult); echo "</pre>";
	$usrID = $arResult['USER_ID'];
	CForm::GetResultAnswerArray($FORM_ID,     $arrColumns,     $arrAnswers,     $arrAnswersVarname,     array("RESULT_ID" => $arResult['ID']));

/*
echo "<pre>";
echo "arrColumns:";
print_r($arrColumns);
echo "arrAnswers:";
print_r($arrAnswers);
echo "arrAnswersVarname:";
print_r($arrAnswersVarname);
echo "</pre>";
*/
?>										
												<div class="msglines" data-id="<?=$arResult['ID']?>">
													<div class="pict">
														<div class="img"><img src="/bitrix/templates/tour/images/user_03.jpg" /></div>
													</div>
													<div class="infomsg">
														<h4><?=$arrAnswersVarname[$arResult['ID']]["NAME"][0]["USER_TEXT"]?></h4>
														<span><?=$arrAnswersVarname[$arResult['ID']]["THEME"][0]["USER_TEXT"]?></span>
														<p><?=$arrAnswersVarname[$arResult['ID']]["QUESTIONS"][0]["USER_TEXT"]?></p>
													</div>
													<div class="msgtime">
														<span class="time"><?=date("d.m.Y",strtotime($arResult['DATE_CREATE']))?></span>
													</div>
												</div>
												<?}?>	
												
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="onlinechat" >
											<div class="chattop">
												<div class="userinfo">
												
													<div class="small"><img src="/bitrix/templates/tour/images/user_03.jpg" height="100%" /></div>
													<span class="fio">Иванова Ольга</span>
													<span class="online">онлайн</span>
												</div>
												<input type="text" class="searchbtn" placeholder="Поиск среди сообщений" />
												<i class="fa fa-search redishz"></i>
											</div>
											<div class="chatroom">
											
												
											</div>
											<div class="chatbot">
											<form id="chatmeplease">
												<input type="file" style="display:none" name="chatfile">
												<input type="hidden" name="chatid" value="">
												<i class="addfile fa fa-paperclip"></i>
												<textarea name="chatmsg" class="chat" placeholder="Введите текст сообщения"></textarea>
												<a href="#" >отправить сообщение</a>
											</form>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
						<div role="tabpanel" class="tab-pane " id="docs">
							<div class="row ">
								<div class="col-md-6">
									<h2>Список документов</h2>
									<table>
										<tr>
											<th>Название файла</th>
											<th>Дата загрузки</th>
											<th> </th>
										</tr>
										<?
						$arSelect = Array();
						$arFieldz = Array();
$arFilter = Array("IBLOCK_ID"=>26,"PROPERTY_FROMUSER"=>$USER->GetID());
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()){
	$arFieldz = $ob->GetFields();
	$arProps = $ob->GetProperties();
/*
	echo "<pre>";
	var_dump($arFieldz);
	echo "</pre>";
	echo "<pre>";
	var_dump($arProps);
	echo "</pre>";
*/
?>
										<tr data-rowid="<?=$arFieldz['ID']?>">
											<td><?=$arFieldz['NAME']?></td>
											<td><?=date("d.m.Y",strtotime($arFieldz['DATE_CREATE']))?></td>
											<td> 
												<i class="fa fa-paper-plane-o send"></i>
												<i class="fa fa-download download"></i>
												<i class="fa fa-print print"></i>
												<i class="fa fa-remove delete"></i>
											</td>
										</tr>
										<?}?>
									</table>
								</div>
								<div class="col-md-6">
								<form id="loadFile">
									<h2>Загрузить документ</h2>
									<div class="group-control">
										<input type="text" name="docname" class="form-control docsName" placeholder="Укажите название документа">
										<input type="file" name="upload" style="display:none;">
										<input type="hidden" name="isfile" value="true">
									</div>
									<button>выбрать файл</button>
									<progress id="progressbar" value="0" max="100"></progress>
								</form>
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