<?php

if (!file_exists('key.txt')) file_put_contents('key.txt', "");

$response = array(
	"status" => "200",
	"key" => file_get_contents('key.txt'),
	"age" => time()-filemtime('key.txt')
);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(floor($response["status"]));
echo json_encode($response);
