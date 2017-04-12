<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курсы по туризму");?>
<style>
body {
	background:url(/bitrix/templates/tour/images/bgr/teach_bg.jpg);
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
.whiteback {
	background:rgba(255,255,255,.8);
	padding:40px;
	border-radius:5px;
	margin-bottom: 40px;
}
.teacher {
	margin-top:100px;
}
.infocourse {
	color:#fff;
}
.akcia {
	background: #fff url(/bitrix/templates/tour/images/teach_fon.jpg) no-repeat right;
    height: 346px;
	padding:70px;
	margin-bottom:60px;
	border-radius:5px;
}
.this-box {
    position: absolute;
    z-index: 100;
    top: 130;
    left: 60;
    background: #fff;
    border-radius: 5px;
    padding: 20px 40px 40px 40px;
    font-size: 16px;
    font-weight: bold;
}
label {
    display: block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: normal;
    font-size: 13px;
    color: #999;
    margin-top: 20px;
}

.this-box a.link {
	color:#333;
	border-bottom:2px solid #db3636;
}

.this-box a.question {
	font-size:10px;
	font-weight:bold;
	text-transform:uppercase;
	background:#db3636;
	border-radius:25px;
	padding:0 40px;
	line-height:33px;
	display:inline-block;
	color:#fff;
}
.mapa {
	margin-bottom:40px;
	    background: rgba(255,255,255,.8);
    border-radius: 5px;
}
.teacher h1 {

	color:#fff;
	font-size:30px;
	font-weight:bold;
	text-align:center;
}
.infocourse h3 {
	font-size:24px;
	font-weight:bold;
	text-align:center;
}
.infocourse p { 
	line-height:27px;
	font-size:16px;
	text-align:center;
}
.courselinks  { 
	text-align:center;
	margin-bottom:60px;
}
.courselinks a { 
	font-size:16px;
	font-weight:bold;
	text-transform:uppercase;
	background:#db3636;
	border-radius:25px;
	padding:0 50px;
	line-height:55px;
	display:inline-block;
	margin:0 15px;
	color:#fff;
}
.akcia h2 {
	font-size:30px;
	font-weight:bold;
	margin: 0 0 20px 0;

}
.akcia p {
	font-size:20px;
	font-weight:bold;
}
.akcia p span{
	font-size:20px;
	font-weight:bold;
	display:inilne-block;
	color:#fff;
	background:#db3636;
	border-radius:5px;
	padding:5px 10px;
}
.akcia a{
	font-size:13px;
	font-weight:bold;
	text-transform:uppercase;
	background:#db3636;
	border-radius:25px;
	padding:0 40px;
	line-height:44px;
	display:inline-block;
	margin:15px 0 0 0;
	color:#fff;
}
.pict {
	border-radius:5px;
	overflow:hidden;
	height:200px;
}
.courseinfo h2 {
	font-size:30px;
	font-weight:bold;
	margin-top:0;
}
.courseinfo  {
	margin-bottom:70px;
}
.courseinfo p {
	line-height:27px;
	font-size:16px;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	font-size: 30px;
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
    font-size: 30px;
	
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 4px solid #c0bdbb;
	background:none;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 10px 35px;
}
.nav-tabs > li, .nav-pills > li {
    float:none;
    display:inline-block;
    *display:inline; /* ie7 fix */
     zoom:1; /* hasLayout ie7 trigger */
}

.nav-tabs, .nav-pills {
    text-align:center;
}
.tab-content h4 {
	
    font-weight: bold;
    font-size: 20px;
}
.tab-content ul {
	list-style:none;
	padding: 0 0 0 20px;
}
.tab-content li {
	font-size: 16px;
	line-height:22px;
	width: 50%;
    float: left;
    padding-right: 25px;
    margin-bottom: 10px;

}
.tab-content li::before {
  content: "• ";
  color: #db3636;
      margin-left: -20px;
    float: left;
}
.redbox {
	border:7px solid #db3636;
	border-radius:5px;
	padding:30px;
	font-size:16px;
}
.redbox span{
	display:inline-block;
	padding:5px 10px;
	font-size:13px;
}
.redbox s{
	color:#999;
}
.redbox a{
	font-size:13px;
	font-weight:bold;
	text-transform:uppercase;
	background:#db3636;
	border-radius:25px;
	padding:0 45px;
	line-height:44px;
	display:inline-block;
	margin:15px 0 0 0;
	color:#fff;
}
.lenttvit {
	margin:30px 0;
	position:relative;
}
.lenttvit .pict{
	overflow:hidden;
	width:100px;
	height:100px;
	border-radius:50%;
	float:left;
	margin-right:20px;
}
.lenttvit .pict img{
	height:100%;
}
.lenttvit h4{
	margin-top:0;
	font-size:16px;
	font-weight:bold;
	margin-bottom: 22px;
}
.lenttvit p{
	font-size:13px;
	line-height:22px;
}
.lenttvit i{
	color:#db3636;
	font-size: 16px;
    position: absolute;
    top: 27px;
}
.mapinfocurs {
	padding: 40px 40px 40px 10px;
	font-size:16px;
	line-height:27px;
}
.mapinfocurs h4{
	margin-top:0;
	font-weight:bold;
}
.mapinfocurs p{
	
}
</style>
<div class="container teacher">
	
	<div class="row infocourse">
		<div class="col-md-6 col-md-offset-3">
			<h1> Курсы по туризму</h1>
			<h3>О курсах</h3>
			<p>Идейные соображения высшего порядка, а также новая модель организационной деятельности в значительной степени обуславливает создание модели развития. Повседневная практика показывает, что начало повседневной работы по формированию позиции позволяет выполнять важные задания по разработке позиций, занимаемых участниками в отношении поставленных задач. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание позиций, занимаемых участниками в отношении поставленных задач.</p>
			<p>Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет оценить значение форм развития. Значимость этих проблем настолько очевидна, что дальнейшее развитие различных форм деятельности в значительной степени обуславливает создание соответствующий условий активизации.</p>

		</div>
	</div>
	
	<div class="courselinks">
	<?
	$itms = array();
	
	$arSelect = Array("ID","NAME","DESCRIPTION","PICTURE");
$arFilter = Array("IBLOCK_ID"=>4 );
$res = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, false,$arSelect);
while($ob = $res->GetNextElement())
{
	 $progs = $ob->GetFields();
	if($progs['ID']!=145) echo '<a href="#pro'.$progs["ID"].'">'.$progs["NAME"].'</a>';
	$itms[] = $progs;
}
?>
	</div>
	<div class="row ">
		<div class="col-md-12">
			<div class="akcia">
				<div class="row ">
					<div class="col-md-7">
						<h2>До начала ближайшей программы осталось всего 4 дня!</h2>
						<p>Успей записаться со скидкой <span>20%</span></p>
						<a href="#" class="iwant" data-toggle="modal" data-target="#buyonline" >записаться</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?
		foreach($itms as $p){
			 
			if($p['ID']!=145)  {
				?>
	<div class="row ">
	<a name="pro<?=$p["ID"]?>"></a>
		<div class="col-md-12">
			<div class="whiteback">
				<div class="row ">
					<div class="col-md-12">
						<div class="row courseinfo">
							<div class="col-md-4">
								<div class="pict"><img src="<?=CFile::GetPath($p["PICTURE"])?>" width="100%" /></div>
							</div>
							<div class="col-md-8">
								<h2><?=$p["NAME"]?></h2>
								<p><?=$p["DESCRIPTION"]?></p>
							</div>
						</div>
				<?
				$programs = array();
				$arSelect = Array("ID","IBLOCK_ID","NAME","PREVIEW_TEXT","PROPERTY_KURSLENGTH","PROPERTY_GRAFIK","PROPERTY_TIMETOTEACH","PROPERTY_KURSPRICE","PROPERTY_KURSDISCOUNT");
				$arFilter = Array("IBLOCK_ID"=>4, "SECTION_ID"=>$p['ID'] );
				$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false,Array("nPageSize"=>10000),$arSelect);
				while($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					
					 $programs[] = $arFields;
				}
				?>
				<ul class="nav nav-tabs" role="tablist">
				<?$j=0;
				foreach($programs as $pr){
					$j++;?>
				<li role="presentation" <?if($j==1){?>class="active"<?}?>><a href="#progr<?=$pr['ID']?>" aria-controls="progr<?=$pr['ID']?>" role="tab" data-toggle="tab"><?=$pr["NAME"]?></a></li>
					<?
				}
				?>
				</ul>
				<div class="tab-content">
				<?
				foreach($programs as $pr){
				?>
				<div role="tabpanel" class="tab-pane active" id="progr<?=$pr['ID']?>">
								<h4>Состав курса</h4>
								<div class="row ">
									<div class="col-md-8 ">
										<?=$arFields["PREVIEW_TEXT"]?>
									</div>
									<div class="col-md-4 ">
										<div class="redbox">
											<p><b>Продолжительность курса:</b> <?=$arFields["PROPERTY_KURSLENGTH"]?></p>
											<p><b>График занятий:</b> <?=$arFields["PROPERTY_KURSLENGTH"]?></p>
											<p><b>Время занятий:</b> <?=$arFields["PROPERTY_KURSLENGTH"]?></p>
											<p><b>Стоимость:</b> <?=$arFields["PROPERTY_KURSPRICE"]-($arFields["PROPERTY_KURSPRICE"]*$arFields["PROPERTY_KURSDISCOUNT"])?> Р  <s><?=$arFields["PROPERTY_KURSPRICE"]?></s> <span>-<?=$arFields["PROPERTY_KURSDISCOUNT"]?>%</span></p>
											<a href="#" class="yep" data-toggle="modal" data-target="#buyonline" data-kursid="<?=$pr['ID']?>" >записаться</a>
										</div>
									</div>
								</div>
							</div>
				<?
				}
				?>
				</div>
				
				
				</div>
				</div>
			</div>
		</div>
	</div>
				<?
			
			
			
			}
		}
	?>
	
					
	<div class="row ">
		<div class="col-md-12">
			<h1>Отзывы учеников</h1>
			
		</div>
	</div>
	
	<div class="row ">
		<div class="col-md-12">
			<div class="whiteback">
				<div class="row ">
					<div class="col-md-6">
						
						<div class="lenttvit">
							<div class="pict"><img src="/bitrix/templates/tour/images/user_03.jpg"></div>
							<h4>Анна Иванова</h4>
							 <p><i class="fa fa-quote-right"></i>Таким образом дальнейшее развитие различных форм деятельности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.</p>
						</div>
						<div class="lenttvit">
							<div class="pict"><img src="/bitrix/templates/tour/images/user_03.jpg"></div>
							<h4>Анна Иванова</h4>
							 <p><i class="fa fa-quote-right"></i>Таким образом дальнейшее развитие различных форм деятельности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.</p>
						</div>
					
					</div>
					<div class="col-md-6">
						
						<div class="lenttvit">
							<div class="pict"><img src="/bitrix/templates/tour/images/user_03.jpg"></div>
							<h4>Анна Иванова</h4>
							 <p><i class="fa fa-quote-right"></i>Таким образом дальнейшее развитие различных форм деятельности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.</p>
						</div>
						<div class="lenttvit">
							<div class="pict"><img src="/bitrix/templates/tour/images/user_03.jpg"></div>
							<h4>Анна Иванова</h4>
							 <p><i class="fa fa-quote-right"></i>Таким образом дальнейшее развитие различных форм деятельности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row ">
		<div class="col-md-12">
			<h1>Контакты</h1>
		</div>
	</div>
	
	<div class="row ">
		<div class="col-md-12">
			<div class="mapa">
	
				<div class="row">
					<div class="col-md-9">
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
				"MAP_HEIGHT" => "505px",
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
						<div class="this-box">
							<p>
								<label>Телефон</label>
								8(459)234-45-67
							</p>
							<p>
								<label>E-mail</label>
								<a href="#" class="link">abc@def.com</a>
							</p>
							<p style="margin-top:30px;"><a href="#" class="question">есть вопрос?</a></p>
							
						</div>
					
					</div>
					<div class="col-md-3">
						<div class="mapinfocurs">
						<h4>Не следует, однако забывать, что постоянное</h4>
						<p>Не следует, однако забывать, что постоянное информационно-пропагандистское обеспечение нашей деятельности обеспечивает широкому кругу (специалистов) участие в формировании новых предложений. </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="kurs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<?$APPLICATION->IncludeComponent("bitrix:form.result.new","question",Array(
        
        "SEF_MODE" => "N", 
        "WEB_FORM_ID" => 8, 
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
<div class="container-fluid footer-all" >
<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("footer_inc.php"),
			Array(),
			Array("MODE"=>"html")
		);?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>