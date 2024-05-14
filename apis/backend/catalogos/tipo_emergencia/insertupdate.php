<?php
$dir_fc = "../";
include_once $dir_fc.'data/cat_tipo_emergencia.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/catalogos/tipo_emergencia/insertupdate',function(Request $request, Response $response){

	$id_update 	 = $request->getParam('id_update');

	$descripcion = $request->getParam('descripcion');
	
	$cFn 	 = new cFunction();
	$cAccion = new cCat_t_emergencia();
	
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

		
		if($descripcion == "" ){
			throw new Exception ("Datos incompletos, validar datos de envío");

		}

		$data = array(
			$descripcion
		);

		if(!is_numeric($id_update)){
			throw new Exception ("El elemento id_update debe de ser numérico");
		}

		if($id_update == 0){			

			$insert    = $cAccion->insertReg( $data );
			$strResp   = " insertado ";
			$id_reg    = $insert; 	

		}else{
			
			array_push($data, $id_update ); //con Id
			
			$insert    = $cAccion->updateReg( $data );
			$strResp   = " actualizado ";
			$id_reg    = $id_update; 

		}
		
		if(is_numeric($insert)){
			$msg   = "Registro $strResp correctamente";
			$done  = true;
			
		}else{
			$msg.= " | Error: ".$insert;
		}


		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = $msg;
		$resp->id   = $id_reg;
		
		return $response->withJson($resp,200);
		
			
	}catch(Exception $e){

		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg 	 = "Error: ". $e->getMessage();
		return $response->withJson($resp,400);

	}	   	   
});
