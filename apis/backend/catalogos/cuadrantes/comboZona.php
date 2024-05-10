<?php
$dir_fc = "../";
include_once $dir_fc.'data/cat_cuadrantes.class.php';
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/catalogos/cuadrantes/comboZona',function(Request $request, Response $response){

	$errorInfo  = false;
	$reg		= "";

	$cAccion = new cCat_cuadrantes();
	$cFn 	 = new cFunction();

	$headers = $request->getHeaders();

	$reg  	   = $cAccion->getCatZona();


	class mensaje {
		public $done;
		public $msg;
		public $rows;
	}
   
	try{
		
		$done 	 = false;
		$rows	 = array();
		$msg 	 = "noValido";

		$token 	 = $cFn->getToken( $headers );
	
		if($token == ""){
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt si no es válido tira una exepción

		if($reg->rowCount()>0){

			$rows = array();
			while ($rsRow = $reg->fetch(PDO::FETCH_ASSOC)){		
				$rows[] = $rsRow;
			}

			$done = true;
			$msg  = "Registros consultados correctamente";

		}else{
			$msg  = "No se encuentra registro en la base de datos";
		}
			
		$resp = new mensaje();
		$resp->done  = $done;
		$resp->msg   = $msg;
		$resp->rows  = $rows;

		return $response->withJson($resp,200);
			
	}catch(PDOException $e){
		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = "Error: ".$e->getMessage();
		return $response->withJson($resp,400);
	}
	
});