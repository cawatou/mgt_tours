<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->RestartBuffer();

if(isset($_REQUEST['direction'])&&!empty($_REQUEST['direction'])){
	$you = $_REQUEST['sex'];
	if($you=="m") $you="1de5608b44fb2e2be2f326f60772ebc2"; else $you="a5f8f5504d6cc7b02a04f454bed6530b";
	$find = $_REQUEST['isex'];
	if($find=="m") $find="e8c533323b3e312b55c392681efb09c8"; else $find="fd8721a98517d1161a012e166ebd4d9b";
	CModule::IncludeModule("iblock");
	 $k=0;
	$arSelect = Array();
	$arFilter = Array("IBLOCK_ID"=>17, "PROPERTY_COMCOUNTRY"=>$_REQUEST['direction'],"PROPERTY_com_sex.XML_ID"=>$find, "PROPERTY_com_who.XML_ID"=>$you, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false,Array("nPageSize"=>10000),$arSelect);
	while($ob = $res->GetNextElement())
	{
		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();
		//var_dump($arFields);
		?>
		<? if($k==0||$k%3==0){?><div class="row"><?}?><? $k++; ?>
		<div class="col-md-4 col-xs-12">
			<div class="find-box">
				<div style="text-align:center;">
					<p><img src="<?=CFile::GetPath($arFields["PREVIEW_PICTURE"])?>" class="ava"></p>
					<p><i class="fa fa-eye"></i></p>
					<p><span class="views">  просмотров</span></p>
				</div>
				<ul class="oglavl">
					<li>
						<span class="text">Имя</span>
						<span class="page"><?=$arFields["NAME"]?></span>
					</li>
					<li>
						<span class="text">Телефон</span>
						<span class="page"><?=$arProps["com_phone"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Почта</span>
						<span class="page"><?=$arProps["com_mail"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Пол</span>
						<span class="page"><?=$arProps["com_sex"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Город вылета</span>
						<span class="page"><?=$arProps["com_city"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Ближайшие города</span>
						<span class="page"><?=$arProps["com_citys"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Интересующийся пол</span>
						<span class="page"><?=$arProps["com_who"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Возраст</span>
						<span class="page"><?=$arProps["com_age"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Страна</span>
						<span class="page"><?=$arProps["COMCOUNTRY"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Дата вылета</span>
						<span class="page"><?=$arProps["com_flydate"]["VALUE"]?></span>
					</li>
					<li>
						<span class="text">Дней отдыха</span>
						<span class="page"><?=$arProps["com_day"]["VALUE"]?> дней</span>
					</li>
				</ul>
				<h3>Информация о себе:</h3>
				<p><?=$arFields["PREVIEW_TEXT"]?></p>
				<a href="#" class="more-companion"   >подробнее</a>
				<div class="row">
					<div class="col-md-6 col-xs-4">
						<p class="social">
							<?if(count($arProps["com_links"]["VALUE"])!=0){
								foreach($arProps["com_links"]["VALUE"] as $l){
									
									if(substr_count($l,"vk.com")) echo '<a class="fa fa-vk " href="'.$l.'"></a>';
									if(substr_count($l,"fb.com")) echo '<a class="fa fa-facebook " href="'.$l.'"></a>';
									
								}
							}?>
							
						</p>
					</div>
					<div class="col-md-6 col-xs-8">
						<p class="actualy">
							<b>Поиск актуален до:<br><span ><?=$arProps["com_actualy"]["VALUE"]?></span></b>
						</p>
					</div>
				</div>
			</div>
		</div>
<?if($k%3==0){?></div><?}
	}
	
	
}
?>