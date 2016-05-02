<?php

/*
 * This file is part of Scherzo. - (c) Aymeric Wilke
 */

/********************************************************
/************************ HTTPS ************************/
if($_SERVER['HTTPS'] != 'on') {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();
}
/*******************************************************/
$cacheDir = '../temp/cache';
$REQUEST = $_SERVER[REQUEST_URI];
list($REQUEST, $gets) = explode('?', $REQUEST);
$params = explode('/', $REQUEST); array_shift($params);

$params[0] == 'web' ? array_shift($params) : false;
/*********************** DEVMODE ***********************/
$DEVMODE = $params[0] == 'dev' ? true : false;
$DEVMODE ? array_shift($params) : false;
/************************ CACHE ************************/
if($DEVMODE){PHP_OS === 'Windows' ? exec("rd /s /q {$cacheDir}") : exec("rm -rf {$cacheDir}"); mkdir($cacheDir);}
/*******************************************************/
$REQUEST = '';
foreach($params as $param){$REQUEST .= '/'.$param;}
$REQUEST == '' ? $REQUEST = '/' : false;

include_once('../vendor/twig/twig/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
	'cache' => $DEVMODE ? false : $cacheDir,
));
/********************************************************
********************************************************/



/***************** RENDERING VARIABLES *****************/

$twigVars = array(
	'request' => $REQUEST,
	'gets' => $_GET,
	'dev' => $DEVMODE,
);

/************************ ROUTER ************************/

$routes = array(
	'/' => 'index.html.twig',
	'/error' => 'error.html.twig',
);

/*******************************************************/



/*********************** RESPONSE ***********************
********************************************************/
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
header('X-Frame-Options: SAMEORIGIN');
header('Content-Security-Policy: script-src \'self\'');
if($routes[$REQUEST]){
	echo $twig->render($routes[$REQUEST], $twigVars);
} else {
	echo $twig->render($routes['/error'], $twigVars);
}
/********************************************************
********************************************************/
