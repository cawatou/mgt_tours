<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Горящие туры");
if(!isset($_REQUEST['id'])) header('Location: /');?>
<style>

	/* something start */
	.tour-menu-bottom {
		display: none
	}

	/*something end*/
	body {
		background:url(/bitrix/templates/tour/images/bgr/tours_bgr.jpg);
		background-attachment:fixed;
	}
	.navbar {
		position:fixed !important;
	}
	.tourcard + .tour-menu {
		margin-bottom: 76px;
	}
	.footer-all {
		background-color:#212121;padding-top: 50px;
		padding-bottom: 150px;
	}
	/******** hotels ************/
	.hotthumb, .hotlist {
		float: right;
		border:2px solid #db3636;
		color: #db3636;
		border-radius: 5px;
		width: 42px;
		height: 42px;
		text-align:center;
		padding-top: 13px;
		cursor:pointer;
		margin-left: 10px;
	}
	.hotlist.active {
		background-color:#db3636;
		color: #fff;
	}

	.tourcard h1 {
		padding-top:200px;
		color:#fff;
		font-weight:bold;
		font-size:20px;
		text-transform:uppercase;
		margin:0;
	}
	.tourcard h2 {
		padding-top:55px;
		color:#fff;
		font-weight:bold;
		font-size:30px;
		text-align:center;
		margin-bottom: 40px;
	}
	.icon_tour {
		background:url(/bitrix/templates/tour/images/mapdot_03.png) no-repeat center 155px;
	}
	.icon_time {
		background:url(/bitrix/templates/tour/images/tours_03.png) no-repeat center 17px;
	}
	.icon_hotel {
		background:url(/bitrix/templates/tour/images/tours_14.png) no-repeat center 17px;
	}
	.topturinfo {
		text-align:center;
	}
	.topturinfo p{
		font-size:55px;
		font-weight:bold;
		color:#fffefe;
		margin:0;
	}
	.topturinfo span{
		display:inline-block;
		background-color:#db3636;
		color:#fff;
		font-size:22px;
		font-weight:bold;
		margin:45px 0;
		border-radius: 3px;
		padding: 5px 15px;
	}
	.fly_date {
		font-size:16px;
		font-weight:bold;
		color:#808080;
		background-color:rgba(255,255,255,.8);
		padding: 10px 24px;
		border-radius: 3px;
		text-align: center;
	}
	.fly_date span  {
		display: block;
		color: #333333;
		font-family: "PT Sans";
		line-height: 16px;
	}
	.fly_date  span:nth-child(1) {
		font-size: 16px;
		font-weight: 700;
	}
	.fly_date  span:nth-child(2) {
		font-size: 16px;
		font-weight: 400;
		margin-top: 5px;
		margin-bottom: 5px;
	}
	.ui-tooltip {
		border: none !important;
		background-color: transparent;

	}
	.ui-tooltip-content {
		border: none !important;
		box-shadow: 0 9px 15px rgba(0, 0, 0, 0.3);
		background-color: #ffffff;
		border-radius: 6px;
		height: 30px;
		position: relative;
		line-height: 29px;
		text-align: center;
		width: 129px;

		margin-left: -37px;
		margin-top: 8px;
		font-weight: 700;
		font-size: 13px;
		font-family: "PT Sans";
		color: #333333;

	}
	.ui-tooltip-content::before {
		content: '';
		border: 6px solid transparent;
		border-bottom-color: #fff;
		position: absolute;
		left: calc(50% - 6px);
		top: -12px;
	}
	.fly_date  span:nth-child(3) {
		font-size: 10px !important;
		text-transform: uppercase;
		border-bottom: 1px solid #db3636;
		padding-bottom: 4px;
		cursor: pointer;
	}
	.fly_date  span:nth-child(3):hover {
		border-bottom-color: transparent;
	}
	.fly_date:hover {
		box-shadow:0 0 0 2px #db3636;
		color:#000;
		cursor:pointer;
		background-color: #fff;
	}
	.hotel-carusel .hotels h4, .hotel-carusel .hotels .hotel_eat, .hotel-carusel .hotels p:nth-child(5) {
		-webkit-text-shadow: 0 0 7px rgba(0, 0, 0, .5);
		text-shadow: 0 0 7px rgba(0, 0, 0, .5);
	}
	.fly_date.checked {
		font-size:16px;
		font-weight:bold;
		color:#fff;
		background-color:#db3636;
	}
	.fly_date.checked span {
		color: #fff;
		border-bottom-color: #fff;
	}
	.fly-from {
		background:url(/bitrix/templates/tour/images/tours_07.png) no-repeat center 20px;
		padding: 45px 0 25px 0!important;
	}
	.fly-to {
		background:url(/bitrix/templates/tour/images/tours_10.png) no-repeat center 20px;
		padding: 45px 0 25px 0!important;
	}
	.fly-to span, .fly-from span{

		font-size:14px;
		font-weight:bold;
		color:#666;
	}
	.tour-menu .fly-bgr.one {
		margin-right:15px;
		margin-left: 0;
	}
	.tour-menu .fly-bgr.two {
		margin-left:15px;
		margin-right: 0;
	}
	.fly-bgr {
		background-color:rgba(255,255,255,.8);
		border-radius:5px;
		margin-top: 20px;
	}
	.fly-info {
		height: 90px;
	}
	.fly-info span {
		font-size:16px;
		color:#323232;
		font-weight:bold;
		display:block;
	}
	.fly-info span:first-child {
		font-size:13px;
		color:#808080;
	}
	.tour-menu .col-md-3 {
		text-align:center;
	}
	.tour-menu .flyline .col-md-3 {
		padding:0 12px;
	}
	.tour-menu .flyline .col-md-3:first-child {
		text-align:left;
	}
	.tour-menu .flyline .col-md-3:last-child {
		text-align:right;
	}
	.flyline {
		line-height: 40px;
	}
	.flyline.left {
		margin-left: 15px;
		margin-right: 0;

	}
	.flyline.right {
		margin-left: 0;
		margin-right: 15px;
	}
	.fly-info-block {
		display: table-cell;
		vertical-align: middle;
		height: 90px;
	}

	.hotels {
		background-color:rgba(255,255,255,.8);
		padding:20px;
		border-radius:5px;
		margin-bottom:30px;
		margin-top: 20px;
	}
	.hotels h3 {
		font-size:24px;
		color:#333;
		font-weight:bold;
		margin: 5px 0 0 0;
	}
	.hotels h4 {
		font-size:16px;
		color:#fffefe;
		font-weight:bold;
		text-transform:uppercase;
		margin-top: 0;	
		cursor:pointer;
	}
	.hotels p:nth-child(5) {
		color: #fff;
		font-family: "PT Sans";
		font-size: 13px;
		line-height: 18px;
		font-weight: 700;
		margin-top: 8px;
	}
	.hotels p:nth-child(5) > span {
		font-size: 11px;
		font-weight: 400;
		color: #fffefe;
	}
	.hotels p:nth-child(5) img {
		margin-right: 5px;
	}
	.hotels .hotel_star {
		color:#ffc000;
		display: inline-block;
		margin: 2px 0;
	}
	.hotels .hotel_price {
		color: #db3636;
		background-color: #fff;
		border-radius: 3px;
		font-size: 13px;
		float: right;
		padding: 3px;
		font-weight: bold;
	}
	.hotels .hotel_eat {
		color: #fff;
		font-weight: bold;
		font-size: 13px;
		margin: 8px 0;
	}
	.hotels .hotel {
		
		background-size: cover;
		border-radius:5px;
		padding: 14px;
	}
	.hotels .hotel .links {
		margin:0;
		text-align:center;
	}
	.hotels .hotel a:hover {
		color:#fff;
	}
	.hotels .hotel a {
		color: #fff;
		font-weight: bold;
		font-size: 9px;
		text-decoration: none;
		text-transform: uppercase;
		background-color: #db3636;
		border-radius: 25px;
		display: inline-block;
		padding: 3px 10px;
		width: 70px;
		text-align: center;
	}
	.hotels .hotel:first-child{
		margin-bottom:28px;
	}
	.hotel_discount {
		background: #db3636;
		color: #fff;
		border-radius: 3px;
		padding: 1px 3px;
	}
	.hotel-carusel {
		margin-top:20px;
	}
	.hotel-carusel .owl-prev {
		background: url(/bitrix/templates/tour/images/tours_17.png) no-repeat;
		text-indent:-9999px;
		width: 42px;
		height: 42px;
		position: absolute;
		top: -200px;
		left: -75px;
	}
	.hotel-carusel .owl-next {
		background: url(/bitrix/templates/tour/images/tours_20.png) no-repeat;
		text-indent: -9999px;
		width: 42px;
		height: 42px;
		position: absolute;
		top: -200px;
		right: -75px;
	}
	.hotel-line div {
		display: table-cell;
		vertical-align: middle;
	}
	.hotel-line {
		height: 50px;
		margin-bottom: 10px;
		background: #fff;
		display: table;
		width: 100%;
		border-radius: 5px;
	}
	.hotel-line .img {
		background: url(/bitrix/templates/tour/images/big_pic_06.jpg) no-repeat center center;
		width: 260px;
		height: 50px;
		border-radius: 5px 0 0 5px;
	}
	.hotel-line .hotel-name {
		min-width:195px;
		padding-left:15px;
	}
	.hotel-line .hotel-name h4{
		font-weight:bold;
		color:#343434;
		font-size:15px;
		margin: 0;
	}
	.hotel-line .hotel-name span{
		font-weight:bold;
		color:#323232;
		font-size:13px;
	}
	.hotel-line .hotel-star {
		width: 110px;
		color:#ffc000;
		text-align:left
	}
	.hotel-line .hotel-price {
		text-align: center;
		min-width: 110px;
	}
	.hotel-line .hotel-price span {
		color: #fff;
		background: #db3636;
		font-size: 16px;
		font-weight: bold;
		padding: 5px 10px;
		border-radius: 5px;
	}
	.hotel-line .hotel-links {
		width:300px;
		text-align:center;
	}
	.hotel-line .hotel-links a{
		display:inline-block;
		font-size:10px;
		color:#fff;
		padding:5px 15px;
		background:#db3636;
		border-radius:15px;
		margin-left: 10px;
	}
	.hotel-list {
		display:none;
		margin-top: 20px;
	}
	.mar80 {
		margin-top: 80px;
	}

	.form-order-info {
		color:#333;
	}

	.form-order-info .info-country{
		text-transform:uppercase;
		font-size:16px;
		font-weight:bold;
	}
	.form-order-info .info-reis{
		font-size:20px;
		font-weight:bold;
	}
	.form-order-info .info-hotel{
		color:#808080;
		font-size:13px;
		margin:0;
	}
	.form-order-info .info-hotel-name{
		font-size:16px;
		font-weight:bold;
	}
	.form-order-info .info-eats{
		color:#808080;
		font-size:13px;
		margin:0;
	}
	.form-order-info .info-eats-desc{
		font-size:16px;
		font-weight:bold;
	}
	.form-order-info .info-fly{
		color:#808080;
		font-size:13px;
		margin:0;
	}
	.form-order-info .info-fly-desc{
		font-size:16px;
		font-weight:bold;
	}
	#order h3 {
		color:#333;
		font-size:20px;
		font-weight:bold;
		line-height: 35px;
	}
	.yellow {
		color:#ffc000;
	}
	.disabled {
		background: #ccc;
		color: #fff;
		border: 0;
		border-radius: 25px;
		padding: 12px 77px;
		font-size: 16px;
		text-transform: uppercase;
		font-weight: bold;
	}
	.byeme {
		background: #db3636;
		color: #fff;
		border: 0;
		border-radius: 25px;
		padding: 12px 77px;
		font-size: 16px;
		text-transform: uppercase;
		font-weight: bold;
	}
	.orderend .comment {
		font-size:11px;
		color:#666;
		display: block;
		text-align:center;
	}
	.orderend label {
		color:#808080;
		font-size:13px;
		margin:0;
	}
	.form-order-info h4 {
		font-size:16px;
		font-weight:bold;
		color:#333;
		margin-top: 30px;
	}
	.form-order-info ul{
		padding: 0;
		margin-bottom: 40px;
	}
	.form-order-info li{
		list-style:none;
	}
	.reddish {
		color:#db3636;
		margin-right: 20px;
	}
	.price_box span{
		color: #db3636;
		text-align: center;
		display: block;
		font-weight: bold;
		font-size: 30px;
		line-height: 89px;
	}
	.price_box {
		border: 2px solid #e0e0e0;
		height: 90px;
		width: 198px;
		border-radius: 5px;
		margin-top: 10px;
	}
	.pad0 {
		padding: 0;
	}
	/*******************************************for mobile ******************************************/
	@media all and (max-width:1000px){

		.pad0 {
			padding: 0 15px;
		}
		.flyline.right,	.flyline.left {
			margin-left: 0;
			margin-right: 0;
		}
		.fly_date {
			font-size: 10px;
			padding: 9px 9px;
		}
		.fly_date.checked {
			font-size: 10px;
		}
		.tour-menu .fly-bgr.two,.tour-menu .fly-bgr.one {
			margin-right: 0;
			margin-left: 0;
		}
		.hotel-carusel .owl-prev {

			left: -34px;
		}
		.hotel-carusel .owl-next {

			right: -34px;
		}
		.tourcard h1 {
			padding-top: 80px;
			font-size: 20px;
			margin: 0;
		}
		.icon_tour {
			background: url(/bitrix/templates/tour/images/mapdot_03.png) no-repeat center 38px;
		}
		.topturinfo p {
			font-size: 35px;
		}
		.topturinfo span {
			font-size: 18px;
			margin: 35px 0;
		}
		.tourcard h2 {
			padding-top: 55px;
			font-size: 20px;
			margin-bottom: 20px;
			margin-top: 0;
		}

		.hotel-line .img {
			min-width: 50px;
			height: 50px;
		}
		.hotel-line .hotel-name {
			min-width: 105px;
			padding-left: 5px;
		}
		.hotel-line .hotel-name h4 {
			font-size: 10px;
			margin: 0;
		}
		.hotel-line .hotel-name span {
			font-size: 8px;
		}
		.hotel-line .hotel-star {
			width: 150px;
			font-size: 8px;
			position: absolute;
			margin-left: -160px;
			margin-top: 20px;
			text-align: right;
		}
		.hotel-line .hotel-price span {
			padding: 5px 2px;
			width: 60px;
			display: inline-block;
		}
		.hotel-line .hotel-links a {
			display: inline-block;
			font-size: 8px;
			padding: 3px 8px;
			border-radius: 15px;
			margin-left: 0;
			margin-top: 3px;
		}
	}

	.hotel-carusel {
		margin-left: -10px;
		margin-right: -10px;
	}
	.hotel-carusel .item{
		width: 207px;
		height: 178px;
		margin-left: 10px;
		margin-right: 10px;
		display: inline-block;
		margin-bottom: 28px;
	}

	.tabouterwrap {
		position: relative;
	}
	.tabouterwrap .tabwrap {
		top: 0;
		right: 0;
		width: 100%;
		display: none;


	}
	.tabouterwrap .tabwrap.active {
		display: block;
	}
</style>
<style>
	.hotel-list p:nth-child(4) {
		color: #343434;
		font-weight: 700;
		font-family: "PT Sans";
		font-size: 13px;
		margin-top: 7px;
		margin-right: 30px;

	}
	.hotel-list p:nth-child(4) img {
		margin-right: 6px;
	}
	.hotel-list p:nth-child(4) > span {
		color: #343434;
		font-weight: 400;
		font-family: "PT Sans";
		font-size: 11px;

	}
	.hotel-list p:nth-child(4) > span span{
		color: #343434;
		font-weight: 400;
		font-family: "PT Sans";
		font-size: 11px;
		border-bottom: 1px solid #db3636;

	}
</style>

<div class="container tourcard">

	<?$APPLICATION->IncludeComponent("bitrix:news.list",
		"tours",
		array(
			"IBLOCK_ID" => 20,
			"PROPERTY_CODE" => array(),
			"FILTER_NAME" => 'arrFilter',
			"CACHE_TYPE" => 'N',
			"PRICE_CODE" => array("BASE"),
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
			),
		false
		);
		?>

		<div class="container-fluid footer-all" >
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("footer_inc.php"),
				Array(),
				Array("MODE"=>"html")
				);?>

			</div>
			<div class="modal fade" id="buyme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Покупка тура</h4>
						</div>
						<div class="modal-body">
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<?$APPLICATION->IncludeComponent("bitrix:form.result.new","order",Array(

							"SEF_MODE" => "N", 
							"WEB_FORM_ID" => 5, 
							"EDIT_URL" => "",
							"CHAIN_ITEM_TEXT" => "", 
							"CHAIN_ITEM_LINK" => "", 
							"IGNORE_CUSTOM_TEMPLATE" => "Y", 

							"SUCCESS_URL" => "", 
							"COMPONENT_TEMPLATE" => "question",

							"LIST_URL" => "result.php", 
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