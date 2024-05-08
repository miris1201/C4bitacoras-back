<?php
$dir_fc = "../";

include_once $dir_fc.'data/cat_colonias.class.php';	
require_once $dir_fc."common/function.class.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/catalogos/colonias/delete',function(Request $request, Response $response){

	$iTipo				= $request->getParam('iTipo');
	$id_delete			= $request->getParam('id_delete');
	
	$cAccion = new cCat_colonias();
	$cFn 	 = new cFunction();
	
	$headers = $request->getHeaders();
	class mensaje {
		public $done;
		public $msg;
	}
   
	try{

		$done = false;
		$msg  = "";
		$token 	 = $cFn->getToken( $headers );
	
		if($token == ""){
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt si no es válido tira una exepción

		if(is_numeric($iTipo) &&
		   is_numeric($id_delete)){
						
			if($iTipo == 2){
				$update    = $cAccion->deleteReg($id_delete);
			}else{

				$data = array($iTipo,
							  $id_delete);

				$update    = $cAccion->updateStatus($data);
			}
			
			if(is_numeric($update)){
				$msg  = "Cambios realizados correctamente";
				$done = 1;
			}else{
				$msg.= " | Error: ".$update;
			}
		}else{
			$msg   = "Validar datos de envío ".$iTipo." | ".$id_delete;
		}

		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = $msg;
		
		return $response->withJson($resp,200);
		
			
	}catch(Exception $e){
		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg 	= "Error: ". $e->getMessage();
		return $response->withJson($resp,400);
	}	   	   
});
