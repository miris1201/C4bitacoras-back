<?php
$dir_fc = "../";
include_once $dir_fc.'data/users.class.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/acceso',function(Request $request, Response $response){

	$txtUser = $request->getParam('user');
	$txtPass = $request->getParam('password');
	$txtPass = hash('sha256',$txtPass);
	// $txtPass = md5($txtPass);
	
	$cUsers	 =	new cUsers();

	class mensaje {
		public $done;
		public $msg;
		public $name;
		public $uid;
		public $token;
		public $menu;
		public $systemOptions;
	}
	
	try{

		$done 	 = false;
		$msg	 = "noValido";
		$uid     = null;
		$id_rol  = null;
		$name    = null;
		$user_name    = null;
		$token   = null;
		$menu    = array();


		$selectUser = $cUsers->getUser($txtUser, $txtPass);

		if($selectUser->rowCount() > 0){

			$data   = $selectUser->fetch(PDO::FETCH_OBJ);

			$uid	 = $data->id_usuario;
			$name    = utf8_encode($data->usuario);
			$id_rol    = $data->id_rol; 

			$systemOptions = array(
				"nombre_completo"=> $data->nombrecompleto,
				"id_rol"=> $data->id_rol,
				//"sexo" => $data->prop,
			);		

			$issuedat_claim = time(); // issued at
			$expire_claim = $issuedat_claim + 17000; // expire time in seconds
			
			$token = array(
				"iss" => _issuer_claim_,
				"aud" => _audience_claim_,
				"iat" => $issuedat_claim,
				"exp" => $expire_claim,
				"data" => array(
					"id" => $data->id_usuario,
				)
			);

			$token  = JWT::encode($token, _SECRET_JWT_);
			
			$done 	 = true;
			$msg 	 = "Usuario con datos";

			$listam  = $cUsers->menuGeneralByUsr(0, $uid);
			
			if($listam->rowCount()>0){

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
			
			}

		}else{

			$msg 	 = "Usuario no válido";

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
		$resp->systemOptions = $systemOptions;
		
		return $response->withJson($resp,200);

	}catch(PDOException $e){

		$resp = new mensaje();
		$resp->done = 0;
		$resp->msg  = $e->getMessage();
		return $response->withJson($resp,200);

	}	   	   
});

