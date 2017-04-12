<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Франшиза");?>
<style>
body {
	background:url(/bitrix/templates/tour/images/bgr/franchize_bg.jpg);
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
.link-room {
	background-color:#212121;
	line-height:70px;
	color:#fff;
}
.franchblog {
	margin-top:100px;
}
.franchblog h1{
	margin:40px 0;
	color:#fff;
	font-size:30px;
	text-align:center;
	font-weight:bold;
}
.franchorder {
	border:10px solid #db3636;
	border-radius:10px;
	background:rgba(255,255,255,.85);
	padding:30px;
}
.franchorder h2 {
	font-size:30px;
	font-weight:bold;
	margin-top:0;
}
.franchorder label {
	font-size:13px;
	color:#999;
}
.franchorder a {
	font-size:13px;
	font-weight:bold;
	background:#db3636;
	display:block;
	border-radius:25px;
	line-height:44px;
	text-transform:uppercase;
	color:#fff;
	text-align:center;
}
.nagrada-carousel  {
	background:rgba(255,255,255,.85);
	border-radius:5px;
	padding:40px 60px;
}
.nagrada-carousel h4 {
	font-size:20px;
	font-weight:bold;
}
.nagrada-carousel p {
	font-size:16px;
	line-height:27px;
}
.hideover {
	display:none;
	position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.8);
    color: #db3636;
    text-align: center;
    line-height: 153px;
    font-size: 3em;
    padding-top: 50%;
}
.pictur {
	width:107px;
	height:153px;
	overflow:hidden;
	position:relative;
	float:left;
	margin: 5px 4px 5px 0;
}
.pictur img{
	
	height:100%;
}
.advant {
	text-align:center;
	color:#fff;
}
.advant .circle{
	text-align:center;
	display:block;
	width:125px;
	height:125px;
	line-height:125px;
	background:#fff;
	border-radius:50%;
	margin:0 auto 30px;
}
.video h3 {
	font-size:20px;
	font-weight:bold;
	color:#fff;
	text-align:center;
}
.video {
	border-radius:5px;
	margin-top:30px;
	margin-bottom:30px;
}

.box h4 span{
	color:#db3636;
}
.box h4{
	font-size:24px;
	font-weight:bold;
	line-height:35px;
	text-align:left;
	margin:0;
}
.box {
	width:50%;
	float:left;
	background:#fff;
	padding:30px 0 30px 30px;
	border-radius: 0 5px 5px 0;
}
.box.calc {
	background:rgba(255,255,255,.8);
	padding-left:40px;
	padding-right:40px;
	border-radius:5px 0 0 5px;
}
.box.calc h4{
	font-size:16px;
	font-weight:bold;
	
}
.box.calc label{
	font-size:13px;
	color:#999;
	font-weight:normal;
}
canvas {
	margin: 40px 0 15px 0;
}
.buble {
	background: #fff;
    border-radius: 50%;
    width: 145px;
    color: #db3636;
    font-size: 20px;
    line-height: 145px;
    text-align: center;    
	display: inline-block;
}
.finan {
	font-size:20px;
	color:#fff;
	text-align: center;
	margin:0 0 80px 0;
}
.link-room a.what{
	color:#fff;
	border-bottom:2px solid #db3636;
	font-weight:bold;
	font-size:16px;
	text-transform:uppercase;
	margin-left: 20px;
}
.link-room a.linkmenu{
	color:#fff;
	font-size:20px;
	font-weight:bold;
	border-radius:25px;
	border:1px solid #fff;
	padding: 5px 15px;
	
}
.whyme {
	background:rgba(255,255,255,.8);
	border-radius:5px;
	padding:45px;
	margin:40px 0;
}
.whyme h4 {
	font-size:30px;
	font-weight:bold;
	margin-top:0;
}
.whyme p {
	font-size:20px;
	line-height:34px;
}
.calcs {
	margin-bottom:80px;
}
</style>
<div class="container franchblog">

		<div class="row ">
			<div class="col-md-12">
				<h1>Франшиза</h1>
			</div>
		</div>
		<div class="row row-flex row-flex-wrap">
			<div class="col-md-9">
				
				<div class="nagrada-carousel owl-carousel">
					<div class="item">
						<div class="row ">
							<div class="col-md-8">
								<h4>Награды и достижения</h4>
								<p>Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности играет важную роль в формировании направлений прогрессивного развития. Таким образом начало повседневной работы по формированию позиции требуют определения и уточнения систем массового участия. Товарищи! укрепление и развитие структуры влечет за собой процесс внедрения и модернизации соответствующий условий активизации.</p>
							</div>
							<div class="col-md-4">
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_07.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_09.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_07.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_09.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="row ">
							<div class="col-md-8">
								<h4>Награды и достижения</h4>
								<p>Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности играет важную роль в формировании направлений прогрессивного развития. Таким образом начало повседневной работы по формированию позиции требуют определения и уточнения систем массового участия. Товарищи! укрепление и развитие структуры влечет за собой процесс внедрения и модернизации соответствующий условий активизации.</p>
							</div>
							<div class="col-md-4">
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_07.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_09.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_07.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
								<div class="pictur">
									<img src="/bitrix/templates/tour/images/about_09.jpg" />
									<div class="hideover">
										<i class="fa fa-search"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="franchorder">
					<h2>Заявка</h2>
					<form>
						<div class="form-group ">
							<label for="iname">Имя</label>
								<input id="iname" class="form-control"  />
						</div>
						<div class="form-group ">
							<label for="phone">Телефон</label>
							<input id="phone" class="form-control" placeholder="+7(___)___-__-__" />
						</div>
						<a href="#">отправить заявку</a>
					</form>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class="col-md-12">
				<h1>Наши приемущества</h1>
			</div>
		</div>
		<div class="row advant">
			<div class="col-md-3">
				<div class="circle"> 
					&nbsp;<img src="/bitrix/templates/tour/images/franshize_12.jpg"> 
				</div>
				<b>Приемущество</b>
				<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
			</div>
			<div class="col-md-3">
				<div class="circle"> 
					&nbsp;<img src="/bitrix/templates/tour/images/franshize_15.jpg"> 
				</div>
				<b>Приемущество</b>
				<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
			</div>
			<div class="col-md-3">
				<div class="circle"> 
					&nbsp;<img src="/bitrix/templates/tour/images/franshize_12.jpg"> 
				</div>
				<b>Приемущество</b>
				<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
			</div>
			<div class="col-md-3">
				<div class="circle"> 
					&nbsp;<img src="/bitrix/templates/tour/images/franshize_15.jpg"> 
				</div>
				<b>Приемущество</b>
				<p>Не следует, однако забывать, что рамки и место обучения кадров в значительной степени.</p>
			</div>
		</div>
	<link rel="stylesheet" href="/video/plyr.css">
	<div class="row video">
		<div class="col-md-4">
			<h3 class="rew">Слово представителя компании</h3>
			<video width="100%" poster="/bitrix/templates/tour/images/bgr/catcountry_bg.jpg" crossorigin>
			   <source src="/video/spring.mpeg" type='video/webm;'>
			   Тег video не поддерживается вашим браузером.
			 </video>
		</div>
		<div class="col-md-4">
			<h3 class="rew">Работа офиса</h3>
			<video width="100%" poster="/bitrix/templates/tour/images/bgr/catcountry_bg.jpg" >
			   <source src="/video/spring.mpeg" type='video/webm;'>
			   Тег video не поддерживается вашим браузером.
			 </video>
		</div>
		<div class="col-md-4">
			<h3 class="rew">Отзывы франчайзи</h3>
			<video width="100%" poster="/bitrix/templates/tour/images/bgr/catcountry_bg.jpg" >
			   <source src="/video/spring.mpeg" type='video/webm;'>
			   Тег video не поддерживается вашим браузером.
			 </video>
		</div>
	</div>
	<div class="row ">
		<div class=" col-md-12" >
			<h1>Калькулятор франшизы</h1>
		</div>
	</div>
	<div class="row calcs">
		<div class=" col-md-12" >
			<div class="box calc">
				<div class="form-group ">
					<label for="cntcity">Население города</label>
						<select id="cntcity" class="form-control"  >
							<option>5-10 тыс.</option>
							<option>10-50 тыс</option>
							<option>50-250 тыс</option>
							<option>250 тыс-1 млн</option>
							<option>> 1 млн</option>
						</select>
				</div>
				<div class="form-group ">
					<label for="cntcity">Название города</label>
						<input id="cntcity" class="form-control"  />
				</div>
				<h4>Объем продаж за последние 3 месяца</h4>
				<div class="form-group ">
					<label for="fmonth">Первый месяц</label>
						<input id="fmonth" class="form-control" placeholder="тыс. руб." />
				</div>
				<div class="form-group ">
					<label for="nmonth">Второй месяц</label>
						<input id="nmonth" class="form-control"  placeholder="тыс. руб." />
				</div>
				<div class="form-group ">
					<label for="lmonth">Текущий месяц</label>
						<input id="lmonth" class="form-control" placeholder="тыс. руб."  />
				</div>
			</div>
			<div class="box">
				<h4>Объем ваших продаж под брендом<br> <span>&laquo;Мой Горящий Тур&raquo;</span></h4>
				
				<canvas id="chart" width="300"></canvas>
			</div>
		</div>
	</div>
	<div class="row ">
		<div class=" col-md-12" >
			<h1>Финансовые показатели</h1>
		</div>
	</div>
	<div class="row finan">	
		<div class=" col-md-3" >
			<div class="buble">
				<b>200 000 Р</b>
			</div>
			<span>Инвестиционный порог</span>
		</div>	
		<div class=" col-md-3" >
			<div class="buble">
				<b>3-4 месяца</b>
			</div>
			<span>Окупаемость</span>
		</div>	
		<div class=" col-md-3" >
			<div class="buble">
				<b>200 000 Р</b>
			</div>
			<span>Инвестиционный порог</span>
		</div>	
		<div class=" col-md-3" >
			<div class="buble">
				<b>3-4 месяца</b>
			</div>
			<span>Окупаемость</span>
		</div>
	</div>
	<div class="row whyme">
		<div class="col-md-12">
			<div class="row ">
				<div class="col-md-7">
					<h4>Почему именно мы?</h4>
					<p>Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности играет важную роль в формировании направлений прогрессивного развития. Таким образом начало повседневной работы по формированию позиции требуют определения и уточнения систем массового участия. Товарищи! укрепление и развитие структуры влечет за собой процесс внедрения и модернизации соответствующий условий активизации.</p>
				</div>
				<div class="col-md-5">
					<img src="/bitrix/templates/tour/images/bgr/lk_bg.jpg" width="100%"/>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid link-room" >
	<div class="container">
		<div class="row ">
			<div class="col-md-12">
				<a href="#" class="linkmenu">позвонить по Skype</a>
				<a href="#" class="linkmenu">Задать вопрос</a>
				<a href="#" class="linkmenu">Заявка на презентацию франшизы онлайн</a>
				<a href="#" class="what">Что такое франшиза?</a>
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