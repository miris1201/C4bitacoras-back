<?php
$dir_fc = "../";
include_once $dir_fc.'data/users.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/admin/user/insertupdate',function(Request $request, Response $response){

	$id_update			= $request->getParam('id_update');

	$id_rol				= $request->getParam('id_rol');
	$id_zona			= $request->getParam('id_zona');
	$usuario			= $request->getParam('usuario');
	$clave				= $request->getParam('clave');
	$no_empleado    	= $request->getParam('no_empleado');
	$nombre				= $request->getParam('nombre');
	$apepa				= $request->getParam('apepa');
	$apema				= $request->getParam('apema');
	$admin				= $request->getParam('admin');
	$sexo				= $request->getParam('sexo');
	$menu				= $request->getParam('menu');

	$cFn 	 = new cFunction();
	$cAccion = new cUsers();
	
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

		
		if($usuario != "" &&
		   is_numeric($id_rol) &&
		   is_numeric($id_zona) &&
		   is_numeric($no_empleado) &&
		   is_numeric($sexo) &&
		   $nombre != "" &&
		   $apema != "" &&
		   $apepa != ""){
		
			$msg = "Datos incompletos, validar datos de envío ".$admin;
		}

			$activo = 1;
			
			if(!isset( $admin )){
				$admin = 0;
			}


			$data = array(
				$id_rol,
				$id_zona,
				$usuario,
				hash('sha256', $clave),
				$no_empleado,
				$nombre,
				$apepa,
				$apema,
				$sexo, 
				$admin,
				$activo
			);


			if(!is_numeric($id_update)){
				throw new Exception ("El elemento id_update debe de ser numérico");
			}
			
			$makeHash  = false; 

			if($id_update == 0){
				
				if($clave == ""){
					throw new Exception ("La clave de usuario es requerida");
				}

				if($cAccion->getRegByUserName($usuario)){
					throw new Exception ("El nombre de usuario ya se encuentra registrado");
				}

				$insert    = $cAccion->insertReg( $data );
				$strResp   = " insertado ";
				$id_reg    = $insert; 	

			}else{
				array_pop( $data );	//sin activo
				array_pop( $data ); //sin clave
				
				array_push($data, $id_update ); //con Id
				

				$insert    = $cAccion->updateReg( $data );
				$strResp   = " actualizado ";
				$id_reg    = $id_update; 

			}
			
			if(is_numeric($insert)){
				$msg   = "Registro $strResp correctamente";
				$done  = true;

				//Actualizar - ingresar nuevos permisos 
				if( is_array($menu)){

					//Borrar los anteriores
					$cAccion->deleteRegUsMenu( $id_reg );
					//Ingresar los nuevos
					foreach ($menu as $key => $value) {
										
						if($value["isChecked"]){

							$array_val = array(
								$id_reg, 
								$value["id_menu"], 
								0, 
								0, 
								0, 
								0,
								0
							);
							//Cabecera
							$cAccion->insertRegdtluser( $array_val );

						}

						if( is_array( $value["_children"] )){
							foreach ($value["_children"] as $key => $valueChild) {
								if( $valueChild["value"] == 1){

									$array_val = array(
										$id_reg, 
										$valueChild["id_menu"], 
										$valueChild["imp"], 
										$valueChild["edit"], 
										$valueChild["elim"], 
										$valueChild["nuevo"], 
										$valueChild["exportar"], 
									);
									//Hijos
									$cAccion->insertRegdtluser( $array_val );

								}
							}
						}
					}
				}
				
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
		return $response->withJson($resp,200);

	}	   	   
});
