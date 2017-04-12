<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//var_dump($arResult);

function mb_strtr($str, $from, $to) {
    return str_replace(mb_str_split($from), mb_str_split($to), $str);
}
function mb_str_split($str) {
    return preg_split('~~u', $str, null, PREG_SPLIT_NO_EMPTY);
}	
function transliterate($st) {
	$st = mb_strtolower($st);
	$st =  mb_strtr($st, 
		"абвгдежзийклмнопрстуфыэ",
		"abvgdejzijklmnoprstufye"
	);
	$st = mb_strtr($st, array(
		'ё'=>"yo", 'х'=>"h", 'ц'=>"cz", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shh", 'ъ'=>'', 'ь'=>'i', 'ю'=>"yu", 'я'=>"ya"
	));
	return $st;
}
if($arResult['PROPERTIES']['FLAG']['VALUE']=='') {
	$flag = transliterate($arResult["NAME"]);
}
else {
	$flag = $arResult['PROPERTIES']['FLAG']['VALUE'];
}
GLOBAL $countryName;
$countryName = $arResult["NAME"];

GLOBAL $tourvisorID;
$tourvisorID = $arResult['PROPERTIES']['TURVID']['VALUE'];
?>
<div class="country-carousel owl-carousel">
		<div class="item ">
			<div class="row ">
				<div class="col-md-5 col-md-offcet-1">
					<div class="Obj">
						<h2><img src="/images/Flags/png/<?=$flag?>.png" width="50px" alt="флаг"/> <?=$arResult["NAME"]?></h2>
						<p><?echo $arResult["PREVIEW_TEXT"];?></p>
					</div>
				</div>
				<div class="col-md-5">
					<div class="img">
						<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
			alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
			title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
			/>
					</div>
				</div>
			</div>
		</div>
		<div class="item ">
			<div class="row ">
				<div class="col-md-6">
					<div class="Obj">
						<h2><img src="/images/Flags/png/<?=$flag?>.png" width="50px" alt="флаг"/> <?=$arResult["NAME"]?></h2>
						<p><?echo $arResult["DETAIL_TEXT"];?></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="img">
						<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
					</div>
				</div>
			</div>
			
		</div>
	</div>