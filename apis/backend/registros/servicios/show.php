<?php
$dir_fc = "../";
include_once $dir_fc.'data/servicios.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/registros/servicios/show',function(Request $request, Response $response){

	$idShow  = $request->getParam('idShow');

	$cFn 	 = new cFunction();
	$cAccion = new cServicios();
	class mensaje {
		public $done;
		public $msg;
		public $rows;
		public $menu;
	}

	try{
		
		$done 	 = false;
		$rowsV 	 = array();
		$rowsDTL = array();
		$rows	 = array();
		$msg 	 = "noValido";

		if($idShow == ""){
			throw new Exception("No se recibieron los parámetros de manera correcta");
		}
		
		$headers = $request->getHeaders();
		
		$token 	 = $cFn->getToken( $headers );
	
		if($token == ""){
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt, si no es válido tira una exepción

		$reg = $cAccion->getRegbyid( $idShow );

		if($reg->rowCount() == 0){
			$msg  = "No se encuentra registro en la base de datos";
		}
			
		$rows = array();
		while ($rsRow = $reg->fetch(PDO::FETCH_ASSOC)){		
			$rows = $rsRow;
		}

		$folio = $cAccion->getDataIdServicio($idShow);

		// $regD = $cAccion->getDataDtl( $folio );
		// if ($regD->rowCount()) {
		// 	while ($rsRowD = $regD->fetch(PDO::FETCH_ASSOC)){		
		// 		$rowsDTL = $rsRowD;
		// 	}
		// }

		// $rows['servicio_dtl'] = $rowsDTL;
		

		$regV = $cAccion->getDataVehiculo( $folio );
		if ($regV->rowCount()) {
			while ($rsRowV = $regV->fetch(PDO::FETCH_ASSOC)){		
				$rowsV = $rsRowV;
			}
		}

		$resultado  = array_merge($rows, $rowsV);


		
		$done = true;
		$msg  = "Registros consultados correctamente";

		
		
		$resp = new mensaje();
		$resp->done  = $done;
		$resp->msg   = $msg;
		$resp->rows  = $resultado;

		return $response->withJson($resp,200);
			
	}catch(Exception $e){
		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = "Error: ".$e->getMessage();
		return $response->withJson($resp,400);
	}	   	   
});
