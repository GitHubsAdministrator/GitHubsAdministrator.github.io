<?php
header("Content-Type: text/html; charset=UTF-8");
define('INDEX_PATH',__DIR__ . "/../../");
include INDEX_PATH . 'Lib/Zip.php';

$zip = INDEX_PATH . 'Tmp/2.2.2/file.zip';
if(!is_file($zip))
	die('0');
$zip_lib = new \Lib\Zip;
$zip_lib->unzip($zip,INDEX_PATH);
if($zip_lib->unzip($zip,INDEX_PATH))
	rename($zip,INDEX_PATH . 'Tmp/2.2.2/file.zip.back');
die("1");
