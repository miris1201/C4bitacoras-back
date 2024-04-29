<?php
$dir_fc = "../";
include_once $dir_fc.'data/rol.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/admin/rol/insertupdate',function(Request $request, Response $response){

	$id_update			= $request->getParam('id_update');

	$rol				= $request->getParam('rol');
	$descripcion		= $request->getParam('descripcion');
	$menu				= $request->getParam('menu');

	$cAccion = new Rol();
	$cFn 	 = new cFunction();

	$headers = $request->getHeaders();
	
	class mensaje {
		public $done;
		public $msg;
		public $id;
	}
   
	$done	 = false;
	$msg     = "";
	$id 	 = 0;
	$descripcion = ( $descripcion == null) ? '' : $descripcion;

	try{

		$token 	 = $cFn->getToken( $headers );
	
		if($token == ""){
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt, si no es válido tira una exepción

		if($rol != ""){

			$data = array(
				$rol,
				$descripcion
			);

			if(!is_numeric($id_update)){
				throw new Exception ("El elemento id_update debe de ser numérico");
			}

			if($id_update == 0){
				$insert    = $cAccion->insertReg( $data );
				$strResp   = " insertado ";
				$id    	   = $insert;
			}else{
				array_push($data, $id_update ); //con Id
					
				$insert    = $cAccion->updateReg( $data );
				$strResp   = " actualizado ";
				$id		   = $id_update;
				
			}
			
			if(is_numeric($insert)){
				$msg   = "Registro $strResp correctamente";
				$done  = true;

				//Actualizar - ingresar nuevos permisos 
				if( is_array($menu)){

					//Borrar los anteriores
					$cAccion->deleteRegRM( $id );

					//Ingresar los nuevos
					foreach ($menu as $key => $value) {
										
						if($value["isChecked"]){

							$array_val = array(
								$id, 
								$value["id_menu"], 
								0, 
								0, 
								0, 
								0,
								0
							);
							//Cabecera
							$cAccion->insertRegdtl( $array_val );

						}

						if( is_array( $value["_children"] )){
							foreach ($value["_children"] as $key => $valueChild) {
								if( $valueChild["value"] == 1){

									$array_val = array(
										$id, 
										$valueChild["id_menu"], 
										$valueChild["imp"], 
										$valueChild["edit"], 
										$valueChild["elim"], 
										$valueChild["nuevo"], 
										$valueChild["exportar"], 
									);
									//Hijos
									$cAccion->insertRegdtl( $array_val );

								}
							}
						}
					}
				}
			}else{
				$msg.= " | Error: ".$insert;
			}
		}else{
			$msg   = "Validar datos de envío ".$rol;
		}

		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = $msg;
		$resp->id   = $id;
		
		return $response->withJson($resp,201);
		
			
	}catch(Exception $e){
		$resp = new mensaje();
		$resp->done  = $done;
		$resp->msg 	 = "Error: ". $e->getMessage();
		return $response->withJson($resp,400);
	}	   	   
	
});