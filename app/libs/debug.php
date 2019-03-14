<?php

//Общие настройки
ini_set ('error_reporting', E_ALL);
ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting(E_ALL);


function debug($str) {
	echo '<pre>';
	var_dump($str);
	echo '</pre>';
	exit;
}