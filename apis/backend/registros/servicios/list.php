<?php
$dir_fc = "../";

include_once $dir_fc.'data/servicios.class.php';
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/registros/servicios/list',function(Request $request, Response $response){

	$regIni  = $request->getParam('regIni');
	$regFin  = $request->getParam('regFin');
	$filtroB = $request->getParam('filtroB');
	$isExport = $request->getParam('isExport');
	$filtroD = $request->getParam('filtroD');
	$filtroS = $request->getParam('filtroS');
	$id_zona = $request->getParam('id_zona');
	$id_rol = $request->getParam('id_rol');

	$cFn 	 = new cFunction();
	$cAccion = new cServicios();
	
	$headers = $request->getHeaders();

	class mensaje {
		public $done;
		public $msg;
		public $rows;
		public $count;
	}
   
	try{

		$token 	 = $cFn->getToken( $headers );
	
		if($token == "") {
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt, si no es válido tira una exepción


		$totalReg  = $cAccion->getAllReg( 0, $regIni, $regFin, $filtroB, $filtroD, $filtroS, $id_rol, $id_zona );

		$limitReg = ( $isExport == 1 ) ? 0 : 1;

		$lista     = $cAccion->getAllReg( $limitReg, $regIni, $regFin, $filtroB, $filtroD, $filtroS, $id_rol, $id_zona );
		
		$done 	   = false;
		$rows	   = array();
		$msg   	   = "noValido";
		$count 	   = 0;

		$count = $totalReg->rowCount();

		if($count > 0){

			while ($rsRow = $lista->fetch(PDO::FETCH_ASSOC)){
				$rows[] = $rsRow;
			}

			$done = true;	
			$msg   = "Lista consultada correctamente";
		}

		$resp = new mensaje();
		$resp->done 	= $done;
		$resp->msg 		= $msg;
		$resp->rows		= $rows;
		$resp->count	= $count;

		return $response->withJson($resp,200);
		
	}catch(Exception $e){
		$resp = new mensaje();
		$resp->done		= false;
		$resp->msg		= "error ".$e->getMessage();
		return $response->withJson($resp,200);
	}	      
});
