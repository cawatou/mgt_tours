<?
define("AUTH","i@neoz.su");
define("PASS","jICPOQJ7");
GLOBAL $cityArr,$operatorArr,$countryArr,$TVID,$User_city;
if(CModule::IncludeModule("altasib.geoip"))
{
	$CITY_ID = $APPLICATION->get_cookie("CITY_ID");
	
	if(empty($CITY_ID)){
		$User_city = ALX_GeoIP::GetAddr();
	}else {
		
	}
}
CModule::IncludeModule("iblock");
$yvalue = 16;
$arSelect = Array("ID","NAME", "UF_CITYID");
$arFilter = Array("IBLOCK_ID"=>16 );
$res = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter, false,$arSelect);
while($ob = $res->GetNextElement())
{
	 $arFields = $ob->GetFields();
	 $city[$arFields['ID']] = $arFields['NAME'];
	if(!empty($CITY_ID)){
		 $officeForCity = $CITY_ID;
		 if( $arFields['ID']==$CITY_ID ) {
			 $User_city['city']  = $arFields['NAME'];
			 //$CURRENT_CITY = 
		 }
	}
	else {
		if( $arFields['NAME']==$User_city['city'] )  $officeForCity = $arFields['ID'];
	}
	$city_tourvisor[$arFields['ID']] = $arFields['UF_CITYID'];
}

/********meals*********/
$meals = array();
\Bitrix\Main\Loader::includeModule('highloadblock');
$hlblock_id = 5;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);

$entity_data_class = $entity->getDataClass();
$entity_table_name = $hlblock['TABLE_NAME'];

$arFilter = array();

$sTableID = 'tbl_'.$entity_table_name;
$rsData = $entity_data_class::getList(array(
	"select" => array('*'),
	"filter" => $arFilter,
	"order" => array("UF_TVID"=>"ASC")
));
$rsData = new CDBResult($rsData, $sTableID);
while($arRes = $rsData->Fetch()){
	
	$meals[$arRes["ID"]]['id'] = $arRes["UF_TVID"];
	$meals[$arRes["ID"]]['name'] = $arRes["UF_MEALNAME"];
	$meals[$arRes["ID"]]['fullname'] = $arRes["UF_FULLNAME"];
	$meals[$arRes["ID"]]['russian'] = $arRes["UF_MEALRUSSIAN"];
	$meals[$arRes["ID"]]['russianfull'] = $arRes["UF_MEALRUSSIANFULL"];
			
}

/*
	справочники
	$cityArr городов
	$operatorArr туроператор
	$countryArr стран
*/
$json = file_get_contents('http://tourvisor.ru/xml/list.php?authlogin='.AUTH.'&authpass='.PASS.'&format=json&type=departure');
$cityArr = json_decode($json);

$json = file_get_contents('http://tourvisor.ru/xml/list.php?authlogin='.AUTH.'&authpass='.PASS.'&format=json&type=operator');
$operatorArr = json_decode($json);

$json = file_get_contents('http://tourvisor.ru/xml/list.php?authlogin='.AUTH.'&authpass='.PASS.'&format=json&type=country');
$countryArr = json_decode($json);

foreach($cityArr->lists->departures->departure as $c){
	if($c->name==$User_city['city']) {
		$TVID = $c->id;
	}
}


?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.fullPage.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/owl.carousel.min.css" />
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/animate.css" />
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.formstyler.css" />
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.jscrollpane.css" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
#page-preloader {
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background: #fff;
    z-index: 100500;
}

#page-preloader .spinner {
        width: 276px;
    height: 76px;
    position: absolute;
    left: 50%;
    top: 50%;
    background: url(/bitrix/templates/tour/images/preloaderlogo.png) no-repeat 50% 50%;
    -webkit-background-size: 100%;
    background-size: 100%;
    margin: -30px 0 0 -138px;
}
</style>
</head>

<body>

<div class="formobileviewport"></div>

<div id="page-preloader"><span class="spinner"></span></div>

<?
if($_REQUEST['dev']) echo "<pre>".print_r($city_tourvisor, 1)."</pre>";


foreach ($city as $key => $c) $array[mb_substr($c,0,1)][$key] = $c;

$citychko ='';	 

foreach($array as $symbol => $sub_array)
{
    $citychko .= '<li><h3>'.  $symbol.'</h3><div class="letterlist">';
    foreach($sub_array as $key => $ct)
    {
        $citychko .=  '<p><a href="#" data-citytv="'.$city_tourvisor[$key].'" data-city="'.$key.'" ';  if($ct==$User_city['city']) $citychko .=  ' class="active" '; $citychko .=  '>'.$ct.'</a></p>' ;
    }
    $citychko .=  '</div></li>	';
}
?>
<ul class="navigation">
			<li class="nav-item cl"><a></a></li>
			<li class="mobile-city"> <span style="margin-right: 0;"><?=$User_city['city']?></span> <i class="glyphicon glyphicon-triangle-bottom" style="color:#db3636;font-size:0.5em;margin-right: 20px;"></i>
			</li>
			<li class="mobile-calls"> <a href="#" class="callback" data-toggle="modal" data-target="#callback"><i class="glyphicon glyphicon-earphone" style="color:#fff;margin-right:10px;"></i> Заказать обратный звонок</a> </li>
			<?$APPLICATION->IncludeComponent(
		"bitrix:menu", 
		"tabs", 
		Array(
			"ROOT_MENU_TYPE"	=>	"top",
			"MAX_LEVEL"	=>	"1",
			"USE_EXT"	=>	"N",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "N",
			"MENU_CACHE_GET_VARS" => Array()
		)
	);?>
		</ul>
<div class="cityAll2" ><ol id="cityx2"><?=$citychko?></ol></div>
		<nav class="navbar">
			<ul>
				<li><a href="/" noindex="noindex"><img style="height: 52px" src="<?=SITE_TEMPLATE_PATH?>/images/logosecondversion.png"></a></li>
				<li class="citys">
					<span style="margin-right: 0;"><?=$User_city['city']?></span>
					<i class="glyphicon glyphicon-triangle-bottom" style="color:#db3636;font-size:0.5em;margin-right: 20px;"></i>
					<div class="cityAll" ><ol id="cityx"><?=$citychko?></ol></div>
				</li>
				<li class="phones"> 
				<span><b>8 812 123 45 67 </b></span> 
				<span class="p2">8 800 900 80 70 </i></span>
				</li>
				<li class="addresses" style="position:relative;"><i class="glyphicon glyphicon-map-marker red-style" ></i> <b>Адреса офисов</b> 
					<div class="adressAll">
						<span class="mob-close">X</span>
						<div class="choodeTown">Выбор города <i class="glyphicon glyphicon-triangle-bottom" style="color:#db3636;font-size:0.5em;margin-right: 20px;"></i></div>
						<ul></ul>
						<br style="clear:both;">
					</div>
				</li>
				<li class="lk"> <?
				if ($USER->IsAuthorized()){?>
					<a href="/lk/" class="fa fa-user" ></a>
				<?}else {?>
					<a href="#" class="fa fa-user" data-toggle="modal" data-target="#login" ></a>
				<?}?>
					 
				</li>
				<li> <a href="#" class="callback" data-toggle="modal" data-target="#callback" ><i class="glyphicon glyphicon-earphone" style="color:#fff;margin-right:10px;"></i> Заказать обратный звонок</a> </li>
				<li class='expandMenu'> 
					<i class="line"></i>
					<i class="line"></i>
					<i class="line"></i>
				</li> 
			</ul>
		</nav>
