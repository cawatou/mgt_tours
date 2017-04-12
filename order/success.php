<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка принята");?>
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
	font-weight:bold;
}
.order h2{
	text-align:center;
	color:#333;
	font-size:24px;
	font-weight:bold;
}
.overflow {
	background:rgba(255,255,255,.8);
	border-radius:5px;
	padding:30px;
	margin-bottom:40px;
}
.ico {
	    color: #db3636;
    border: 2px solid #db3636;
    padding: 0 18px;
    font-size: 30px;
    border-radius: 50%;
    line-height: 66px;
    background: #fff;
}
.formas {
	text-align:center;
}
.form-group {
	margin-bottom:30px;
}
.formas a:hover {
	background:#f27979;
	text-decoration:none;
}
.formas a, #payOnline input[type=submit] {
	color:#fff;
	background:#db3636;
	border-radius:25px;
	display:inline-block;
	padding:0 78px;
	font-size:13px;
	font-weight:bold;
	text-transform:uppercase;
	line-height:44px;
	border:0;
}
</style>

<?
$ORDER_ID = $_REQUEST['id'];
?>

				
				<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.detail","",Array(
        "PATH_TO_LIST" => "",
        "PATH_TO_CANCEL" => "",
        "PATH_TO_PAYMENT" => "/order/pay.php",
        "PATH_TO_COPY" => "",
        "ID" => $ORDER_ID,
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "PICTURE_WIDTH" => "110",
        "PICTURE_HEIGHT" => "110",
        "PICTURE_RESAMPLE_TYPE" => "1",
        "GUEST_MODE" => "Y",
        "CUSTOM_SELECT_PROPS" => array(),
        "PROP_1" => Array(),
        "PROP_2" => Array()
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