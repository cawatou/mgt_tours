<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?>
<style>
body {
	background:url(/bitrix/templates/tour/images/bgr/job_bgr.jpg);
	background-attachment:fixed;
}
.navbar {
	position:fixed !important;
}

.footer-all {
	background-color:#212121;padding-top: 50px;
    padding-bottom: 150px;
}
/****************************************************/
.job-head  {
	margin-bottom:50px;
}
.job-head h1 {
	color:#fff;
	font-size:30px;
	font-weight:bold;
	margin:165px 0 20px 0;
	text-align:center;

}
.job-box {
	background-color:rgba(255,255,255,.8);
	padding:30px;
	border-radius:5px;
}
.job-box h3{
	font-size:16px;
	font-weight:bold;
	margin:0 0 10px 0;
}
.job-box p{
	font-size:13px;
	line-height:22px;
}
.job-box div{
	line-height: 90px;
}
.job-box div b{
	font-size:16px;
}
.job-box div span{
	float:right;
	color:#db3636;
	font-size:16px;
	font-weight:bold;
}
.job-box a{
	display:block;
	text-transform:uppercase;
	font-size:11px;
	font-weight:bold;
	border-radius:25px;
	text-align:center;
	padding: 12px 0;
	
}
.job-box a.iwant{
	background-color:#db3636;
	color:#fff;
	margin-bottom:10px;
}
.job-box a.iwant:hover{
	background-color:#e65858;
	color:#fff;
	text-decoration:none;
}
.job-box a.more{
	color:#db3636;
	border:1px solid #b3b3b3;
}
.job-box a.more:hover{
	color:#fff;
	background-color:#db3636;
	
	text-decoration:none;
}
#jobinfo .jobinfo{
	max-height:680px;
	overflow-x: hidden;
    overflow-y: scroll;
}

#jobinfo .jobinfo::-webkit-scrollbar-track
{
	//-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #e6e6e6;
}

#jobinfo .jobinfo::-webkit-scrollbar
{
	width: 40px;
	background-color: #db3636;
}

#jobinfo .jobinfo::-webkit-scrollbar-thumb
{
	background-color: #db3636;
	border: none;
}
.jobinfo h3{
	font-size: 30px;
    font-weight: bold;
    margin: 0 0 10px 0;
}
.jobinfo h4{
	font-size:20px;
	font-weight:bold;
}
.jobinfo p{
	font-size:16px;
}
.jobinfo ul {
	padding:20px;
}
.jobinfo li::before {
  content: "• ";
  color: #db3636;
      margin-left: -20px;
    float: left;
}
.jobinfo li{
	list-style:none;
	font-size:16px;
	line-height:27px;

}
#jobinfo a {
	background-color:#db3636;
	color:#fff;
	font-size:16px;
	font-weight:bold;
	display:block;
	border-radius:25px;
	margin-top: 40px;
	padding: 19px 0;
	text-align:center;
}
.job-full-text {
	display:none;
}
/*******************************************for mobile ******************************************/
@media all and (max-width:1000px){
	.job-head h1 {
		font-size: 20px;
		margin: 60px 0 20px 0;
	}
}
</style>
<div class="container job-head">
	<div class="row">
		<div class="col-md-12">
			<h1>Вакансии в <?=$User_city['city']?></h1>
		</div>
	</div>
	<?
	global $arrFilter;
	$arrFilter = array(
		"PROPERTY_CITY" =>$officeForCity,
	);
	?>
	
	<?$APPLICATION->IncludeComponent("bitrix:news.list", "jobs", Array(
					"IBLOCK_TYPE"	=>	"service",
					"IBLOCK_ID"	=>	"11",
					"NEWS_COUNT"	=>	"12",
					"SORT_BY1"	=>	"ACTIVE_FROM",
					"SORT_ORDER1"	=>	"DESC",
					"SORT_BY2"	=>	"SORT",
					"SORT_ORDER2"	=>	"ASC",
					"FILTER_NAME"	=>	"arrFilter",
					"FIELD_CODE"	=>	array(
					),
					"PROPERTY_CODE"	=>	array(
						0	=>	"MONEY",
						1	=>	"CITY",
					),
					"DETAIL_URL"	=>	"/content/job/#ELEMENT_ID#/",
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
<div class="container-fluid footer-all" >
<?$APPLICATION->IncludeFile(
	$APPLICATION->GetTemplatePath("footer_inc.php"),
	Array(),
	Array("MODE"=>"html")
);?>
</div>
<div class="modal fade" id="jobinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content jobinfo">
			
		</div>
		<a href="#" data-id="" class="otklikjob">откликнуться на вакансию</a>
	</div>
</div>
	
<div class="modal fade" id="jobform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<?$APPLICATION->IncludeComponent("bitrix:form.result.new","question",Array(
        
        "SEF_MODE" => "N", 
        "WEB_FORM_ID" => 6, 
        "EDIT_URL" => "",
        "CHAIN_ITEM_TEXT" => "", 
        "CHAIN_ITEM_LINK" => "", 
        "IGNORE_CUSTOM_TEMPLATE" => "Y", 
       
        "SUCCESS_URL" => "", 
       
        
        
        "USE_EXTENDED_ERRORS" => "Y", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "3600", 
       
        "VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID")
        
    )
);?>
	 </div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>