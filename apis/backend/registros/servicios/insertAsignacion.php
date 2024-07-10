<?php
$dir_fc = "../";
include_once $dir_fc.'data/servicios.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/registros/servicios/insertAsignacion',function(Request $request, Response $response){

	$id_update 		= $request->getParam('id_update');

	$folio		 	 = $request->getParam('folio');
	$id_zona		 = $request->getParam('id_zona');
	$id_usuario_dtl  = $request->getParam('id_usuario_dtl');
	$hasignacion	 = $request->getParam('hasignacion');
	$unidad			 = $request->getParam('unidad');
	$id_cuadrante	 = $request->getParam('id_cuadrante');
	$sector			 = $request->getParam('sector');

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
		   $hasignacion == "" &&
		   $id_usuario_dtl == "" &&
		   $sector == "" &&
		   !is_numeric($id_cuadrante) 
		   ){
			throw new Exception ("Datos incompletos, validar datos de envío");

		}

		$fecha_cap = date("Y-m-d H:i:s");
		$data = array(
			$id_update,
			$folio,
			$id_zona,
			$fecha_cap,
			$id_usuario_dtl,
			$unidad, 			
			$hasignacion
		);


		if(!is_numeric($id_update)){
			throw new Exception ("El elemento id_update debe de ser numérico");
		}
			

		// var_dump($data);
		$update    = $cAccion->insertAsignacion( $data );
		$strResp   = " insertada ";
		$id_reg    = $folio; 	

		
		if(is_numeric($update)){
			$msg   = "Asignación $strResp correctamente";
			$done  = true;

			$cAccion->updateCuadranteServicio( $id_cuadrante, $folio);

			$cAccion->updateStatusServicio( 2, $folio);


			$reg = $cAccion->getRegbyid( $id_update );
			$rows = array();
			while ($rsRow = $reg->fetch(PDO::FETCH_ASSOC)){		
				$rows = $rsRow;
			}

			
		} else {
			$msg.= " | Error: ".$update;

		}


		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = $msg;
		$resp->id   = $id_update;
		$resp->rows = $rows;
		
		return $response->withJson($resp,200);
		
			
	}catch(Exception $e){

		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg 	 = "Error: ". $e->getMessage();
		return $response->withJson($resp,400);

	}	   	   
});
