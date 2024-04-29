<?php
$dir_fc = "../";
include_once $dir_fc.'data/operadores.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/catalogos/operadores/insertupdate',function(Request $request, Response $response){

	$id_update			= $request->getParam('id_update');

	$id_user_flotilla   = $request->getParam('id_user_flotilla');
	$id_tarjeta			= $request->getParam('id_tarjeta');
	$clave				= $request->getParam('password');
	$nombre				= $request->getParam('nombre');
	$apepa				= $request->getParam('apepa');
	$apema				= $request->getParam('apema');
	$correo				= $request->getParam('email');
	$admin				= $request->getParam('admin');
	
	$cFn 	 = new cFunction();
	$cAccion = new cOperadores();
	
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
		   $apema != "" &&
		   $apepa != ""){

			$fecha 	= date('Y-m-d');
			
			if(!isset( $admin )){
				$admin = 0;
			}
			
			$id_user_flotilla = ($id_user_flotilla == "") ? null : $id_user_flotilla;
			$id_tarjeta = ($id_tarjeta == "") ? null : $id_tarjeta;

			$data = array(
				$nombre,
				$apepa,
				$apema,
				$correo,
				$id_user_flotilla,
				$id_tarjeta,
				hash('sha256',$clave),
				$fecha
			);

			if(!is_numeric($id_update)){
				throw new Exception ("El elemento id_update debe de ser numérico");
			}

			if($id_update == 0){
				
				if($clave == ""){
					throw new Exception ("La clave de usuario es requerida");
				}

				if($cAccion->getRegByEmail($correo)){
					throw new Exception ("El email ya se encuentra registrado");
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
			$msg = "Datos incompletos, validar datos de envío ".$admin;
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
