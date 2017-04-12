<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();

define("AUTH","i@neoz.su");
define("PASS","jICPOQJ7");


$json = file_get_contents('http://tourvisor.ru/xml/hotel.php?authlogin='.AUTH.'&authpass='.PASS.'&hotelcode='.$_REQUEST['id'].'&reviews=1&format=json');

$arr = json_decode($json);

//var_dump($arr );

if($_REQUEST['a']=='pic') {
	echo $arr->data->hotel->images->image[0];
}
if($_REQUEST['a']=='rew') {
?>
				<div class="head-info">
					<b>Рейтинг отеля:</b> &nbsp; <span class="green"><?=$arr->data->hotel->rating?></span> &nbsp; <span class="counter">(отзывов: <?=$arr->data->hotel->reviewscount?>)</span> &nbsp; <a href="#">Добавить свой отзыв об этом отеле</a>
				</div>
				<?if($arr->data->hotel->reviewscount>0){
					  foreach($arr->data->hotel->reviews->review as $key => $rew) {
					if($key%2==0) echo '</div>';
					if($key==0||$key%2==0) echo '<div class="row">';
					?>
				
					<div class="col-md-6">
						<h3><?=$rew->name?></h3> 
						<span class="date"><?=$rew->reviewdate?></span>
						<span class="vota">Оценка: <b><?=$rew->rate?></b></span>
						<p><?=$rew->content?> </p>
						<a href="#"  class="more">Читать отзыв полностью...</a>
					</div>
					<?}?>
				<?
					if($arr->data->hotel->reviewscount%2==1){
						echo '</div>';
					}
				}
}
if($_REQUEST['a']=='map') {
	$PLACEMARKS = array();
	$APPLICATION->IncludeComponent("bitrix:map.google.view",".default",array(
    "API_KEY" => "AIzaSyDVcwlJJsdy7gvq6LePrBSLE5UvPuIqrvg",
	"INIT_MAP_TYPE" => "MAP",
	"MAP_DATA" => serialize(
                  array(
                     'google_lat' => $arr->data->hotel->coord1, // координаты центра карты
                     'google_lon' => $arr->data->hotel->coord2, // используем координаты последнего маркера
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
    "MAP_ID" => "googlemaps".$_REQUEST['id']
    )
	);
}
if($_REQUEST['a']=='about') {
?>
				<div class="row">
					<div class="col-md-3">
					 <? $k=0; foreach($arr->data->hotel->images->image as $pic) {
						
						 ?>
						<div class="small"><img src="<?=$pic?>"></div>
					 <?
					 $k++; if($k==9) break;
					 }?>
						<br style="clear:both;">
						<a href="/catalog/hotel/<?=$_REQUEST['id']?>">Все фотографии</a>
					</div>
				
					<div class="col-md-9">
						<?if(!empty($arr->data->hotel->placement)){?><p>Расположение:<br><br><?=$arr->data->hotel->placement?></p><?}?>
						<?if(!empty($arr->data->hotel->description)){?><p><b>Территория отеля:</b> <?=$arr->data->hotel->description?></p><?}?>
						<?if(!empty($arr->data->hotel->roomtypes)){?><p><b>Номера:</b> - <?=$arr->data->hotel->roomtypes?></p><?}?>
						<?if(!empty($arr->data->hotel->beach)){?><p><b>Пляж:</b> - <?=$arr->data->hotel->beach?></p><?}?>
					
					</div>
				</div>
<?}?>