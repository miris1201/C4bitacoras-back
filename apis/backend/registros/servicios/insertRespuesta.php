<?php
$dir_fc = "../";
include_once $dir_fc.'data/servicios.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/registros/servicios/insertRespuesta',function(Request $request, Response $response){

	$id_update 		= $request->getParam('id_update');

	$folio		 	 = $request->getParam('folio');
	$resultado		 = $request->getParam('resultado');
	$hrecibe		 = $request->getParam('hrecibe');
	$harribo		 = $request->getParam('harribo');
	$id_emergencia_cierre = $request->getParam('id_emergencia_cierre');
	$id_usuario_cierre = $request->getParam('id_usuario_cierre');
	$id_tipo_cierre  = $request->getParam('id_tipo_cierre');
	$id_tipo_emergencia = $request->getParam('id_tipo_emergencia');

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

		
		if($folio != "" &&
		   $resultado != "" &&
		   $hrecibe != "" &&
		   $harribo != "" &&
		   !is_numeric($id_emergencia_cierre) &&
		   !is_numeric($id_tipo_cierre) &&
		   !is_numeric($id_tipo_cierre) 
		   ){
			throw new Exception ("Datos incompletos, validar datos de envío");

		}

		$fecha_cap = date("Y-m-d H:i:s");
		$data = array(
			$resultado,
			$hrecibe,
			$harribo,
			$id_emergencia_cierre,
			$id_usuario_cierre,
			$fecha_cap, 			
			$id_tipo_cierre,
			$id_tipo_emergencia,
			$folio
		);


		if(!is_numeric($id_update)){
			throw new Exception ("El elemento id_update debe de ser numérico");
		}
			

		// var_dump($data);
		$update    = $cAccion->insertResultado( $data );
		$strResp   = " insertado ";
		$id_reg    = $folio; 	

		
		if(is_numeric($update)){
			$msg   = "Resultado $strResp correctamente";
			$done  = true;

			$cAccion->updateStatusServicio( 3, $folio);


			$reg = $cAccion->getRegbyid( $id_update );
			$rows = array();
			while ($rsRow = $reg->fetch(PDO::FETCH_ASSOC)){		
				$rows = $rsRow;
			}

			
		}else{
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
