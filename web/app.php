<?php

/*
 * This file is part of Scherzo. - (c) Aymeric Wilke
 */

/********************************************************
/************************ HTTPS ************************/
// if($_SERVER['HTTPS'] != 'on') {
//     header('HTTP/1.1 301 Moved Permanently');
//     header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//     exit();
// }
/*******************************************************/
$cacheDir = '../temp/cache';
$REQUEST = $_SERVER['REQUEST_URI'];
strstr($REQUEST, '?') ? list($REQUEST, $gets) = explode('?', $REQUEST) : $gets = [];
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

include_once('../vendor/autoload.php');

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
header('Content-Security-Policy: script-src \'unsafe-inline\' \'self\' https://code.jquery.com https://cdnjs.cloudflare.com https://stackpath.bootstrapcdn.com');
if(array_key_exists($REQUEST, $routes)){
	echo $twig->render($routes[$REQUEST], $twigVars);
} else {
	header("HTTP/1.0 404 Not Found");
	echo $twig->render($routes['/error'], $twigVars);
}
/********************************************************
********************************************************/
