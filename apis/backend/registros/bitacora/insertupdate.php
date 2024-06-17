<?php
$dir_fc = "../";
include_once $dir_fc.'data/bitacoras.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/registros/bitacora/insertupdate',function(Request $request, Response $response){

	$id_update 	= $request->getParam('id_update');

	$folio			 = $request->getParam('folio');
	$id_usuario		 = $request->getParam('id_usuario');
	$id_zona		 = $request->getParam('id_zona_b');
	$id_departamento = $request->getParam('id_departamento');
	$unidad			 = $request->getParam('unidad');
	$fecha			 = $request->getParam('fecha');
	$hora			 = $request->getParam('hora');
	$detalle 		 = $request->getParam('detalle');
	
	$cFn 	 = new cFunction();
	$cAccion = new cBitacoras();
	
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

		
		if($detalle != "" &&
		   $unidad != "" &&
		   !is_numeric($id_zona) &&
		   !is_numeric($id_departamento)){
			throw new Exception ("Datos incompletos, validar datos de envío");

		}

		$folio = $cAccion->getFolioMax();
		$folioDuplicado = $cAccion->checkFolioDuplicado( $folio );
		if ($folioDuplicado > 0 ) {
			$folio = $cAccion->getFolioMax();
		}

		$fecha_cap = date("Y-m-d H:i:s");

		$data = array(
			$folio,
			$fecha_cap,
			$id_usuario,
			$id_zona,
			$id_departamento,
			$unidad,
			$fecha,
			$hora,
			$detalle
		);

		if(!is_numeric($id_update)){
			throw new Exception ("El elemento id_update debe de ser numérico");
		}
			
		$insert    = $cAccion->insertReg( $data );
		$strResp   = " insertado ";
		$id_reg    = $insert; 	

		
		
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
