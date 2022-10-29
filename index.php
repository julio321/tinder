<?php

session_start();

define('INCLUDE_PATH','http://localhost/teste/tinder/');

define('ACTION_LIKE','1');
define('ACTION_DISLIKE','0');


$autoLoad = function($class){
	include($class.'.php');
};

spl_autoload_register($autoLoad);

//new MySql();

if(!isset($_SESSION['login']) && $_GET['url'] != 'login'){
	header('location: '.INCLUDE_PATH.'login');
	die();
}

$url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'home';

if(file_exists('pages/'.$url.'.php')){
	include('pages/'.$url.'.php');
}else{
	die('Não existe nenhuma página com este nome!');
}
?>