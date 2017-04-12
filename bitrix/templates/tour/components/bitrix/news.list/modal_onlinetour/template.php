<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->RestartBuffer();
$login = 'i@neoz.su';
$pass = 'jICPOQJ7';
$detail_info = file_get_contents('http://tourvisor.ru/xml/actualize.php?authlogin=' . $login . '&authpass=' . $pass . '&tourid=' . $_REQUEST['tourid']. '&format=json' );
$detail_info = json_decode($detail_info, 1);
$result = $detail_info['data']['tour'];

$tourinfo = file_get_contents('http://tourvisor.ru/xml/actdetail.php?authlogin=' . $login . '&authpass=' . $pass . '&tourid=' . $_REQUEST['tourid']. '&format=json' );
$tourinfo = json_decode($tourinfo, 1);
$result['departure_time'] = $tourinfo['flights'][0]['forward'][0]['departure']['time'];
$result['tourinfo'] = $tourinfo['tourinfo']['flags'];

if(isset($detail_info['error'])){
	echo $detail_info['error']['errormessage'];
}
else {
?>
<div class="form-order-info">
	<p class="info-country"><?=$result['countryname']?></p>
	<p class="info-reis"><?=$result['departurename']?> — <?=$result['hotelregionname']?></p>
	<h4>В стоимость тура входит:</h4>
	<ul>
		<?if(!$result['tourinfo']['noflight'] == 1):?>
			<li><i class="fa fa-check reddish"></i> Авиаперелет</li>
		<?else:?>
		<?if(!$result['tourinfo']['notransfer'] == 1):?>
			<li><i class="fa fa-check reddish"></i> Трансфер</li>
		<?endif?>
		<?if(!$result['tourinfo']['nomedinsurance'] == 1):?>
			<li><i class="fa fa-check reddish"></i> Медицинская страховка </li>
		<?endif?>
			<li><i class="fa fa-check reddish"></i> Перелет не входит в состав тура (только проживание в отеле)</li>
		<?endif?>
		<?if(!$result['tourinfo']['nomeal'] == 1):?>
			<li><i class="fa fa-check reddish"></i> Проживание в отеле указанной категории с указанным питанием</li>
		<?endif?>
	</ul>

	<p class="info-hotel">Отель</p>
	<p class="info-hotel-name">
		<?=$result['hotelname']?>
		<?for($i=1; $i <= $result['hotelstars']; $i++):?>
			<span class="fa fa-star yellow"></span>
		<?endfor?>
	</p>
	<p class="info-eats">Питание</p>
	<p class="info-eats-desc"><?=$result['meal']?></p>
	<p class="info-fly">Вылет</p>
	<p class="info-fly-desc"><?=$result['flydate']?> <?=($result['departure_time'])?'в '.$result['departure_time'] : '';?> из <?=$result['departurename']?>, <?=$result['nights']?> ночей</p>
</div>

<div class="row orderend">
	<div class="col-sm-6">
		<div class="form-group">
			<label>Количество человек</label>
			<input type="text" name="kount" value="2" style="width:90px;" class="form-control">
			<input type="hidden" name="price_online" value="<?=$result['price']?>" />
			<input type="hidden" name="touridonline" value="<?=$_REQUEST['tourid']?>" />
		</div>
		<button class="byeme">далее</button>
		<span class="comment">Кнопка «ДАЛЕЕ» будет активна после расчета стоимости тура</span>
	</div>
	<div class="col-sm-6">
		<b>Итоговая цена</b>
		<div class="price_box">
			<span><?=$result['price']?> Р</span>
		</div>
	</div>
</div>
<?
}
?>