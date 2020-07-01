<?php

function setLog() {
	//$_SERVER['QUERY_STRING']);
	echo $HTTP_RAW_POST_DATA;
	// Collect data
	$date  =  date("Y-m-d H:i:s");
	$filename = 'log.txt';
	
	$content = "Date: ".$date.PHP_EOL;
	
	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$content .= "URL: ".$url.PHP_EOL;
	
	$data = getData();
	$content .= $data.PHP_EOL;
	
	$content .= "---------------------------------------".PHP_EOL;
	// Save to  file 
	file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);
	
	// Print. Tips: replace PHP_EOL with <br>
	echo str_replace(array("\r\n", "\r", "\n"), '<br>', $content);
}

function getData()
{
	$result = "";
	
	// Handling headers
	$result .= "Headers:".PHP_EOL;
	$headers = get_request_headers();
	$result .= $headers;
	
	// Handling raw GET params
	if(!empty($_GET)) {
		$result .= "Raw GET: ".$_SERVER['QUERY_STRING'].PHP_EOL;
	}
	
	// Handling raw POST params
	if(!empty($_POST)) {
		$result .= "Raw POST: ".file_get_contents("php://input").PHP_EOL;
	}
	
	return $result;
}

function get_request_headers() {
    $headers = "";
    foreach($_SERVER as $key => $value) {
        if(strpos($key, 'HTTP_') === 0) {
			$headers .= str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5))))).":".$value.PHP_EOL;
        }
    }
    return $headers;
}

setLog();

?>