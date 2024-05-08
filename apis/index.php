<?php
require '../connections/php_config.php';
require '../connections/trop.php';
require 'vendor/autoload.php';

$app = new \Slim\App;

$config = [
	'settings' => ['displayErrorDetails' => $showErrors]
];

$app = new Slim\App($config);

$app->add(function ($req, $res, $next) {
	$response = $next($req, $res);
	return $response
		->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
		->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
});

$url_actual = $server_name . $_SERVER["REQUEST_URI"];

$datos = parse_url($url_actual);

foreach ($datos as $key => $value) {
	//Accesos
	if ($value == $api_complemento . "/apis/acceso") {
		require_once('backend/acceso.php');
	} elseif ($value == $api_complemento . "/apis/token") {
		require_once('backend/token.php');
	} elseif ($value == $api_complemento . "/apis/menu/list") {
		require_once('backend/menu/list.php');
	} elseif ($value == $api_complemento . "/apis/menu/listGeneric") {
		require_once('backend/menu/listGeneric.php');
	}
	//Admin Users
	elseif ($value == $api_complemento . "/apis/admin/user/list") {
		require_once('backend/admin/user/list.php');
	} elseif ($value == $api_complemento . "/apis/admin/user/show") {
		require_once('backend/admin/user/show.php');
	} elseif ($value == $api_complemento . "/apis/admin/user/delete") {
		require_once('backend/admin/user/delete.php');
	} elseif ($value == $api_complemento . "/apis/admin/user/insertupdate") {
		require_once('backend/admin/user/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/admin/user/updatepassword") {
		require_once('backend/admin/user/updatepassword.php');
	}
	//Admin Profiles
	elseif ($value == $api_complemento . "/apis/admin/rol/show") {
		require_once('backend/admin/rol/show.php');
	} elseif ($value == $api_complemento . "/apis/admin/rol/combo") {
		require_once('backend/admin/rol/combo.php');
	} elseif ($value == $api_complemento . "/apis/admin/rol/list") {
		require_once('backend/admin/rol/list.php');
	} elseif ($value == $api_complemento . "/apis/admin/rol/insertupdate") {
		require_once('backend/admin/rol/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/admin/rol/delete") {
		require_once('backend/admin/rol/delete.php');
	}
	//Catálogos
	//Colonias
	elseif ($value == $api_complemento . "/apis/catalogos/colonias/list") {
		require_once('backend/catalogos/colonias/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/colonias/show") {
		require_once('backend/catalogos/colonias/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/colonias/insertupdate") {
		require_once('backend/catalogos/colonias/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/colonias/delete") {
		require_once('backend/catalogos/colonias/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/colonias/combo") {
		require_once('backend/catalogos/colonias/combo.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/colonias/comboTipo") {
		require_once('backend/catalogos/colonias/comboTipo.php');
	}  

}

$app->run();
