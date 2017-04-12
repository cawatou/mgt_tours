#!/usr/bin/php
<?$_SERVER['SERVER_NAME'] = 'tour.sub.www23.ru';
$DOCUMENT_ROOT = '/var/www/neoz/data/www/sub.www23.ru/tour';
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
$login = 'i@neoz.su';
$pass = 'jICPOQJ7';
require_once("/var/www/neoz/data/www/sub.www23.ru/tour/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$params = Array(
    'authlogin' => $login,
    'authpass' => $pass,
    'departure' => 1,
    'country' => 4,
    'datefrom' => '03.05.2017',
    'dateto' => '04.07.2017',
    'regions' => 20,
    'nightsfrom' => 2,
    'nightsto' => 5,
    'format' => 'json',
);
foreach ($params as $k => $value) {
    if ($get == '') $get = $k . '=' . $value;
    else $get = $get . '&' . $k . '=' . $value;
}
$json = file_get_contents('http://tourvisor.ru/xml/search.php?' . $get);
$json = json_decode($json, 1);
$requestid = $json['result']['requestid'];
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/dev/cron/requestid.txt', print_r($requestid, 1));
sleep(25);

$json = file_get_contents('http://tourvisor.ru/xml/result.php?authlogin=' . $login . '&authpass=' . $pass . '&requestid=' . $requestid . '&type=status&format=json');
$json = json_decode($json, 1);
$status = $json['data']['status']['progress'];
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/dev/cron/status.txt', print_r($status, 1));

$json = file_get_contents('http://tourvisor.ru/xml/result.php?authlogin=' . $login . '&authpass=' . $pass . '&requestid=' . $requestid . '&type=result&onpage=100&format=json');
$json = json_decode($json, 1);
$result = $json['data']['result']['hotel'];
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/dev/cron/result.txt', print_r($result, 1));
?>