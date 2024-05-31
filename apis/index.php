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

	//Cuadrantes
	elseif ($value == $api_complemento . "/apis/catalogos/cuadrantes/list") {
		require_once('backend/catalogos/cuadrantes/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/cuadrantes/show") {
		require_once('backend/catalogos/cuadrantes/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/cuadrantes/insertupdate") {
		require_once('backend/catalogos/cuadrantes/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/cuadrantes/delete") {
		require_once('backend/catalogos/cuadrantes/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/cuadrantes/combo") {
		require_once('backend/catalogos/cuadrantes/combo.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/cuadrantes/comboSector") {
		require_once('backend/catalogos/cuadrantes/comboSector.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/cuadrantes/comboZona") {
		require_once('backend/catalogos/cuadrantes/comboZona.php');
	} 

	//Operativos
	elseif ($value == $api_complemento . "/apis/catalogos/operativo/list") {
		require_once('backend/catalogos/operativo/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/operativo/show") {
		require_once('backend/catalogos/operativo/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/operativo/insertupdate") {
		require_once('backend/catalogos/operativo/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/operativo/delete") {
		require_once('backend/catalogos/operativo/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/operativo/combo") {
		require_once('backend/catalogos/operativo/combo.php');
	} 

	//Procedencia de llamadas
	elseif ($value == $api_complemento . "/apis/catalogos/procedencia/list") {
		require_once('backend/catalogos/procedencia/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/procedencia/show") {
		require_once('backend/catalogos/procedencia/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/procedencia/insertupdate") {
		require_once('backend/catalogos/procedencia/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/procedencia/delete") {
		require_once('backend/catalogos/procedencia/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/procedencia/combo") {
		require_once('backend/catalogos/procedencia/combo.php');
	} 

	//Tipo de emergencia
	elseif ($value == $api_complemento . "/apis/catalogos/tipo_emergencia/list") {
		require_once('backend/catalogos/tipo_emergencia/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/tipo_emergencia/show") {
		require_once('backend/catalogos/tipo_emergencia/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/tipo_emergencia/insertupdate") {
		require_once('backend/catalogos/tipo_emergencia/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/tipo_emergencia/delete") {
		require_once('backend/catalogos/tipo_emergencia/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/tipo_emergencia/combo") {
		require_once('backend/catalogos/tipo_emergencia/combo.php');
	} 

	//Tipo cierre de emergencia
	elseif ($value == $api_complemento . "/apis/catalogos/tipo_cierre/list") {
		require_once('backend/catalogos/tipo_cierre/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/tipo_cierre/show") {
		require_once('backend/catalogos/tipo_cierre/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/tipo_cierre/insertupdate") {
		require_once('backend/catalogos/tipo_cierre/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/tipo_cierre/delete") {
		require_once('backend/catalogos/tipo_cierre/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/tipo_cierre/combo") {
		require_once('backend/catalogos/tipo_cierre/combo.php');
	} 

	//Departamentos
	elseif ($value == $api_complemento . "/apis/catalogos/departamentos/list") {
		require_once('backend/catalogos/departamentos/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/departamentos/show") {
		require_once('backend/catalogos/departamentos/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/departamentos/insertupdate") {
		require_once('backend/catalogos/departamentos/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/departamentos/delete") {
		require_once('backend/catalogos/departamentos/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/departamentos/combo") {
		require_once('backend/catalogos/departamentos/combo.php');
	} 

	//Emergencias
	elseif ($value == $api_complemento . "/apis/catalogos/emergencias/list") {
		require_once('backend/catalogos/emergencias/list.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/emergencias/show") {
		require_once('backend/catalogos/emergencias/show.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/emergencias/insertupdate") {
		require_once('backend/catalogos/emergencias/insertupdate.php');
	} elseif ($value == $api_complemento . "/apis/catalogos/emergencias/delete") {
		require_once('backend/catalogos/emergencias/delete.php');
	}  elseif ($value == $api_complemento . "/apis/catalogos/emergencias/combo") {
		require_once('backend/catalogos/emergencias/combo.php');
	} 


	//Lista de Bitacoras
	elseif ($value == $api_complemento . "/apis/bitacoras/list") {
		require_once('backend/bitacoras/list.php');
	} elseif ($value == $api_complemento . "/apis/bitacoras/insertupdate") {
		require_once('backend/bitacoras/insertupdate.php');
	} 

}

$app->run();
