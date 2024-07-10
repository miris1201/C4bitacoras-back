<?php
$dir_fc = "../";
include_once $dir_fc.'data/servicios.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/registros/servicios/insertNotas',function(Request $request, Response $response){

	$id_update 		= $request->getParam('id_update');

	$folio		 	= $request->getParam('folio');
	$id_zona		= $request->getParam('id_zona');
	$id_usuario   	= $request->getParam('id_usuario');
	$descripcion	= $request->getParam('descripcion');

	$cFn 	 = new cFunction();
	$cAccion = new cServicios();
	
	$headers = $request->getHeaders();
	
	class mensaje {
		public $done;
		public $msg;
		public $id;
	}
   
	try{

		$done	 = false;
		$msg     = "";
		$id_reg  = 0;
		
		$token 	 = $cFn->getToken( $headers );
	
		if($token == ""){
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt, si no es válido tira una exepción

		
		if($folio == "" &&
		   $id_usuario == "" &&
		   !is_numeric($folio)  &&
		   !is_numeric($id_usuario) &&
		   $descripcion == ""
		   ){
			throw new Exception ("Datos incompletos, validar datos de envío");

		}

		$fecha_cap = date("Y-m-d H:i:s");
		$data = array(
			$folio,
			$id_usuario,
			$fecha_cap,
			$id_zona,
			$descripcion
		);


		if(!is_numeric($id_update)){
			throw new Exception ("El elemento id_update debe de ser numérico");
		}
			
		$update    = $cAccion->insertNotas( $data );
		$strResp   = " insertada ";
		$id_reg    = $folio; 	

		
		if(is_numeric($update)){
			$msg   = "Nota $strResp correctamente";
			$done  = true;

			
			
		} else {
			$msg.= " | Error: ".$update;

		}


		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = $msg;
		$resp->id   = $id_update;
		
		return $response->withJson($resp,200);
		
			
	}catch(Exception $e){

		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg 	 = "Error: ". $e->getMessage();
		return $response->withJson($resp,400);

	}	   	   
});
