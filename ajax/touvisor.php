<?
define('LOGIN','i@neoz.su');
define('PASS','jICPOQJ7');
if(isset($_REQUEST['cntry'])){
	$json = file_get_contents('http://tourvisor.ru/xml/list.php?type=hotel&hotcountry='.$_REQUEST['cntry'].'&hotregion='.$_REQUEST['hreg'].'&authlogin='.LOGIN.'&authpass='.PASS.'&format=json');

	$arr = json_decode($json,1);

	//var_dump($arr);
	foreach($arr["lists"]["hotels"]["hotel"] as $x => $h)
	{
		
		if(mb_substr(mb_strtolower($h["name"]), 0, strlen(mb_strtolower($_REQUEST['term'])),"utf-8") == mb_strtolower($_REQUEST['term']))
		{
			$hot['list'][$x] = array("label" => $h["name"], "value" => $h["name"], "id" => $h["id"]);       
		}
	}

    $response = $_GET["callback"] . "(" . json_encode($hot) . ")";
    echo $response;
}
if(isset($_REQUEST['city'])){
	$json = file_get_contents('http://tourvisor.ru/xml/list.php?authlogin='.LOGIN.'&authpass='.PASS.'&format=json&type=departure');
	$cityArr = json_decode($json,1);
	foreach($cityArr["lists"]["departures"]["departure"] as $x => $h)
	{
		//echo $h["name"].' '. mb_strtolower($_REQUEST['term']).' '.substr(mb_strtolower($h["name"]), 0, strlen($_REQUEST['term']))." ";
		if(substr(mb_strtolower($h["name"]), 0, strlen(mb_strtolower($_REQUEST['term']))) == mb_strtolower($_REQUEST['term']))
		{
			$hot['list'][$x] = array("label" => $h["name"], "value" => $h["name"], "id" => $h["id"]);       
		}
	}

    $response = $_GET["callback"] . "(" . json_encode($hot) . ")";
    echo $response;
}
if(isset($_REQUEST['country'])){
	$json = file_get_contents('http://tourvisor.ru/xml/list.php?authlogin='.LOGIN.'&authpass='.PASS.'&format=json&type=country');
	$countryArr = json_decode($json,1);
	foreach($countryArr["lists"]["countries"]["country"] as $x => $h)
	{
		
		if(substr(mb_strtolower($h["name"]), 0, strlen(mb_strtolower($_REQUEST['term']))) == mb_strtolower($_REQUEST['term']))
		{
			$hot['list'][$x] = array("label" => $h["name"], "value" => $h["name"], "id" => $h["id"]);       
		}
	}

    $response = $_GET["callback"] . "(" . json_encode($hot) . ")";
    echo $response;
}