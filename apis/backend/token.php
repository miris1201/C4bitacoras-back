<?php
$dir_fc = "../";
require_once $dir_fc."common/function.class.php";
include_once $dir_fc.'data/users.class.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/token',function(Request $request, Response $response){

	$cFn 	 = new cFunction();
	$cUsers  = new cUsers();
	
	$headers = $request->getHeaders();
	
	class mensaje {
		public $done;
		public $msg;
		public $uid;
		public $token;
	}
	
	
	try{

		$done 	 = false;
		$msg	 = "noValido";
		$uid     = null;
		$id_rol  = null;
		$name    = null;
		$user_name = null;
		$token   = null;
		$menu    = array();

		try{

			$token 	 = $cFn->getToken( $headers );
			
			if($token == "" || !$token){
				throw new Exception("No token available");
			}

			$decoded = JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt si no es válido tira una exepción
			//Obteniendo el ID del user para consultar sus datos
			$data = $decoded->data;

			if(!is_numeric($data->id) || $data->id <= 0){
				throw new Exception("No se recibió el parámetro de manera correcta");
			}

			$selectUser = $cUsers->getUserById($data->id);

			if($selectUser->rowCount() <= 0){
				throw new Exception("No se encuentran datos con el usuario en curso");
			}

			
			$msg	 = "Token válido";
			$data   = $selectUser->fetch(PDO::FETCH_OBJ);

			$uid	 = $data->id_usuario;
			$name    = utf8_encode($data->nombrecompleto);
			$name    = utf8_encode($data->usuario);
			$id_rol    = $data->id_rol;
			
			$done 	 = true;
			$msg 	 = "Usuario con datos";

			$listam  = $cUsers->menuGeneralByUsr(0, $uid);

			if($listam->rowCount() <=0 ){
				throw new Exception("No se encuentran datos del menú con el usuario seleccionado ");
			}

			while ($rw = $listam->fetch(PDO::FETCH_OBJ)){	
				$id_padre 	= $rw->id_menu; 
				$value		= 0;
				$rsValMain  = $cUsers->validateOnUsrMenu($uid, $id_padre);
				
				//Si el main lo tiene solo regresa el true correspondiente
				if( $rsValMain->rowCount() > 0 ){
					$value = 1;
				}

				$main = array(
					"id_menu" => $rw->id_menu,
					"texto" => $rw->texto,
					"className" => $rw->class,
				);

				$child  	= array();

				$rsChild = $cUsers->menuGeneralByUsr( $id_padre, $uid );
				
				if($rsChild->rowCount()>0){
					
					while( $rwC = $rsChild->fetch(PDO::FETCH_OBJ) ){
						$values   = array();
						$id_menu  = $rwC->id_menu;
						$rsValues = $cUsers->validateOnUsrMenu($uid, $id_menu);
						
						$childMerge = array(
							"id_menu" => $id_menu,
							"texto" => $rwC->texto,
							"link" => $rwC->link,
							"className" => $rwC->class,
						);

						$values = array(
							"imp" => 0,
							"edit" => 0,
							"elim" => 0,
							"nuevo" => 0,
							"exportar" => 0,
						);
						
						if($rsValues->rowCount() > 0 ){
							while( $rwVal = $rsValues->fetch(PDO::FETCH_OBJ) ){
								$values["imp"] = $rwVal->imp;
								$values["edit"] = $rwVal->edit;
								$values["elim"] = $rwVal->elim;
								$values["nuevo"] = $rwVal->nuevo;
								$values["exportar"] = $rwVal->exportar;
							}
						}

						$child[] = array_merge($childMerge, $values);
					}
										
					$main["_children"] = $child;
					
				}
				$menu[] 	= $main;
			}

			

		} catch (\Exception $e) {
			$msg .= $e->getMessage();
		}

		$resp = new mensaje();

		$resp->done 	 = $done;
		$resp->msg   	 = $msg;
		$resp->name      = $name;
		$resp->user_name = $user_name;
		$resp->id_rol 	 = $id_rol;
		$resp->uid    	 = $uid;
		$resp->token     = $token;
		$resp->menu      = $menu;	

		return $response->withJson($resp,200);

	}catch(PDOException $e){

		$resp = new mensaje();
		$resp->done = false;
		$resp->msg  = $e->getMessage();
		return $response->withJson($resp,200);

	}	   	   
});