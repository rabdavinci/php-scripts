<?php

$filename = 'log.txt';

$date  =  date("Y-m-d H:i:s");
$content = "Date: " . $date . PHP_EOL;

// Handling headers
$content .= "Headers:" . PHP_EOL;

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$content .= "Request URL: " . $url . PHP_EOL;

$statusCode = http_response_code();
$content .= "Status Code: " . $statusCode . PHP_EOL;

$headers = get_request_headers_as_string();
$content .= $headers;

// Handling raw GET params
if (!empty($_GET)) {
  $content .= "Query String Parametres: " . PHP_EOL;
  $content .= $_SERVER['QUERY_STRING'] . PHP_EOL;
}

// Handling raw POST params
if (!empty($_POST)) {
  $content .= "Form Data: " . PHP_EOL;
  $content .= file_get_contents("php://input") . PHP_EOL;
}

$content .= "--------------------------------" . PHP_EOL;

// Save to  file 
file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);

// Print
echo str_replace(array("\r\n", "\r", "\n"), '<br>', $content);

/**
 * Parse headers from $_SERVER
 * @return string 
 */
function get_request_headers_as_string()
{
  $headers = "";
  foreach ($_SERVER as $key => $value) {
    if (strpos($key, 'HTTP_') === 0) {
      $headers .= str_replace(' ', '-', ucwords(str_replace(
        '_',
        ' ',
        strtolower(substr($key, 5))
      ))) . ":" . $value . PHP_EOL;
    }
  }
  return $headers;
}
