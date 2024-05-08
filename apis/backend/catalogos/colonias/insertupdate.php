<?php
$dir_fc = "../";
include_once $dir_fc.'data/cat_colonias.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/catalogos/colonias/insertupdate',function(Request $request, Response $response){

	$id_update 	= $request->getParam('id_update');

	$nombre		= $request->getParam('nombre');
	$tipo		= $request->getParam('tipo');
	$sector		= $request->getParam('sector');
	$region		= $request->getParam('region');
	
	$cFn 	 = new cFunction();
	$cAccion = new cCat_colonias();
	
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

		
		if($nombre != "" &&
		   $tipo != "" &&
		   !is_numeric($sector) && $sector == 0 &&
		   !is_numeric($region) && $region == 0){			

			$data = array(
				$nombre,
				$tipo,
				$sector,
				$region
			);

			if(!is_numeric($id_update)){
				throw new Exception ("El elemento id_update debe de ser numérico");
			}

			if($id_update == 0){
				
				if( !is_numeric($sector) && $sector == 0){
					throw new Exception ("Es necesario el sector");
				}

				if( !is_numeric($region) && $region == 0){
					throw new Exception ("Es necesaria la región");
				}

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

		}else{
			$msg = "Datos incompletos, validar datos de envío ";
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
