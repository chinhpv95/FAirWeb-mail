<?php
	include "sendmail.php";

	function getData($id)
	{
    	$json = file_get_contents("http://118.70.72.15:8080/sos-bundle/api/v1/timeseries/$id");
    	$data = json_decode($json, true);
    	return $data;
	}

	$obser = getData($id_choose);
		
    $pm25 = $obser['lastValue']['value'];
    $uom = $obser['uom'];
    $last_time = gmdate("d-m-Y H:i",substr($obser['lastValue']['timestamp'], 0, 10));

    echo $last_time;
 ?>