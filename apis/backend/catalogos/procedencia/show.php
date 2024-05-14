<?php
$dir_fc = "../";
include_once $dir_fc.'data/cat_procedencia.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/catalogos/procedencia/show',function(Request $request, Response $response){

	$idShow  = $request->getParam('idShow');

	$cFn 	 = new cFunction();
	$cAccion = new cCat_procedencia();
	
	class mensaje {
		public $done;
		public $msg;
		public $rows;
		public $menu;
	}

	try{
		
		$done 	 = false;
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

		if($reg->rowCount()>0){
			
			$rows = array();
			while ($rsRow = $reg->fetch(PDO::FETCH_ASSOC)){		
				$rows = $rsRow;
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
			
	}catch(Exception $e){
		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = "Error: ".$e->getMessage();
		return $response->withJson($resp,400);
	}	   	   
});
