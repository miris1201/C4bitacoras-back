<?php
$dir_fc = "../";
include_once $dir_fc.'data/users.class.php';
require_once $dir_fc."common/function.class.php";		

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/admin/user/updatepassword',function(Request $request, Response $response){
	
	$id_usuario			= $request->getParam('id_usuario');
	$old_password		= $request->getParam('old_password');
	$confirm_password	= $request->getParam('confirm_password');
	
	$cAccion = new cUsers();
	$cFn 	 = new cFunction();

	$headers = $request->getHeaders();
	class mensaje {
		public $done;
		public $msg;
	}

	
	try{
		
		$done = false;
		$msg = "";
		
		$token 	 = $cFn->getToken( $headers );
	
		if($token == ""){
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt, si no es válido tira una exepción

		if( !is_numeric($id_usuario) ){
			throw new Exception ("El id del usuario no es válido");
		}
		
		if( $old_password != $confirm_password ){
			throw new Exception ("Las contraseñas no coinciden");
		}

		$data = array( hash('sha256',$confirm_password),
					  $id_usuario );



		$update    = $cAccion->updateRegPW( $data );

		if(!is_numeric( $update)){
			throw new Exception("Ocurrió un inconveniente al realizar el cambio de password".$update);
		}

		$done = true;
		$msg  = "Password actualizado correctamente";
		
			
	}catch(Exception $e){
		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg 	= "Error: ". $e->getMessage();
		
	}	 
	
	$resp = new mensaje();
	$resp->done = $done;
	$resp->msg  = $msg;
	return $response->withJson($resp,200);
});