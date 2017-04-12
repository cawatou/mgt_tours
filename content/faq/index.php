<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Часто задаваемые вопросы");
?>
<style>
body {
	background:url(/bitrix/templates/tour/images/bgr/faq_bgr.jpg);
	background-attachment:fixed;
}
.navbar {
	position:fixed !important;
}

.footer-all {
	background-color:#212121;padding-top: 50px;
    padding-bottom: 150px;
}
/*******************/
.faq-content {
	
}
.faq-head {
	text-align:center;
}
.faq-head h1{
	color:#fff;
	font-size:30px;
	font-weight:bold;
	margin:165px 0 20px 0;
	
}
.faq-head a {
	color: #fff;
    background-color: #db3636;
    border-radius: 25px;
    display: inline-block;
    padding: 11px 41px;
    margin-bottom: 65px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
}
.faq-head a:hover {
	text-decoration:none;
}
.question-box {
	border:10px solid #db3636;
	border-radius:5px;
	background:#fff;
	padding:40px;
}
.question-box h2{
	color:#323232;
	font-size:30px;
	font-weight:bold;
	margin: 0 0 20px 0;
}
.question-box ul {
	padding:0;
	list-style:none;
}
.question-box a {
	display:block;
	border-left:2px solid #ccc;
	padding-left:20px;
	color:#808080;
	font-size:16px;
	line-height: 40px;
}
.question-box a:hover {
	display:block;
	border-left:2px solid #db3636;
	color:#333;
	text-decoration:none;
}
.answer-box h3{
	font-weight:bold;
	color:#333;
	font-size:20px;
	line-height:35px;
	margin:0;
}
.answer-box h3 span{
	color:#999;
	font-size:13px;
	display:block;
	
}
.answer-box p{
	line-height:35px;
	font-size:20px;
	margin-top:10px;
}
.answer-box p span{
	display:block;
	color:#db3636;
	font-weight:bold;
	font-size:13px;
}
.answer-box {
	padding:40px;
	background:#fff;
	border-radius:5px;
	margin-bottom:30px;
}
/*******************************/

.navi-bottom {
	margin-bottom:40px;
	text-align:center;
}

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
/*******************************************for mobile ******************************************/
@media all and (max-width:1000px){
	.faq-head h1 {
		font-size: 20px;
		margin: 60px 0 20px 0;
	}
	.question-box {
		margin-bottom: 20px;
	}
	.question-box h2 {
		font-size: 20px;
		margin: 0 0 20px 0;
	}
	.question-box a {
		font-size: 12px;
		line-height: 25px;
	}
	.answer-box {
		padding: 20px;
		margin-bottom: 15px;
	}
	.answer-box h3 {
		font-size: 14px;
		line-height: 20px;
	}
	.answer-box p {
		line-height: 15px;
		font-size: 10px;
		margin-top: 10px;
	}
	.faq-head a {
		padding: 6px 41px;
		margin-bottom: 35px;
		font-size: 12px;
	}
	.btnformmodalred {
   
    line-height: 25px !important;
}
textarea.form-control {
	height:100px;
}
}
</style>
<div class="container faq-content">
	<div class="row faq-head">
		<div class="col-md-12">
			<h1>Вопрос-ответ</h1>
			<a href="#"  data-toggle="modal" data-target="#question">Задать вопрос</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="question-box">
				<h2>Темы обращения</h2>
				<?$APPLICATION->IncludeComponent("bitrix:support.faq.section.list","tour",Array(
        "IBLOCK_TYPE" => "services", 
        "IBLOCK_ID" => "13", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y", 
        "AJAX_MODE" => "N", 
        "SECTION" => "-", 
        "EXPAND_LIST" => "Y", 
        "SECTION_URL" => "faq_detail.php?SECTION_ID=#SECTION_ID#", 
        "AJAX_OPTION_JUMP" => "N", 
        "AJAX_OPTION_STYLE" => "Y", 
        "AJAX_OPTION_HISTORY" => "N" 
    )
);?>
			</div>
		</div>
		<div class="col-md-8 col-xs-12" id="results">
			<?$APPLICATION->IncludeComponent("bitrix:support.faq.element.list","tour",Array(
				"IBLOCK_TYPE" => "services", 
				"IBLOCK_ID" => "13", 
				"SHOW_RATING" => "Y", 
				"RATING_TYPE" => "like_graphic",
				"PATH_TO_USER" => "",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"CACHE_GROUPS" => "Y", 
				"AJAX_MODE" => "N", 
				"SECTION_ID" => 92, 
				"AJAX_OPTION_JUMP" => "N", 
				"AJAX_OPTION_STYLE" => "Y", 
				"AJAX_OPTION_HISTORY" => "N" 
			)
		);?>

			
			<div class="row">
				<div class="col-md-12 col-xs-12 navi-bottom">
					<a href="#" class="chev"><i class="fa  fa-chevron-left "></i> предыдущая</a>
					<a href="#" class="navg">1</a>
					<a href="#" class="navg active">2</a>
					<a href="#" class="navg">3</a>
					<a href="#" class="navg">4</a>
					<a href="#" class="chev">следующая <i class="fa  fa-chevron-right "></i></a>
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