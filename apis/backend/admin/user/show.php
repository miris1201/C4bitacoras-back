<?php
$dir_fc = "../";
include_once $dir_fc.'data/users.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/admin/user/show',function(Request $request, Response $response){

	$idShow  = $request->getParam('idShow');

	$cFn 	 = new cFunction();
	$cAccion = new cUsers();
	class mensaje {
		public $done;
		public $msg;
		public $rows;
		public $menu;
	}

	try{
		
		$done 	 = false;
		$rows	 = array();
		$msg 	 = "noValido";

		if($idShow == ""){
			throw new Exception("No se recibieron los parámetros de manera correcta");
		}
		
		$headers = $request->getHeaders();
		
		$token 	 = $cFn->getToken( $headers );
	
		if($token == ""){
			throw new Exception("No token available");
		}

		JWT::decode($token, _SECRET_JWT_, array('HS256')); //valida jwt, si no es válido tira una exepción

		$reg = $cAccion->getRegbyid( $idShow );

		if($reg->rowCount()>0){

			$rows = array();
			while ($rsRow = $reg->fetch(PDO::FETCH_ASSOC)){		
				$rows = $rsRow;
			}

			$lista  = $cAccion->menuGeneral(0);

			if($lista->rowCount()>0){

				while ($rw = $lista->fetch(PDO::FETCH_OBJ)){	
					$id_padre 	= $rw->id_menu; 
					$value		= 0;
					$rsValMain  = $cAccion->validateOnUsrMenu($idShow, $id_padre);
					
					//Si el main lo tiene solo regresa el true correspondiente
					if( $rsValMain->rowCount() > 0 ){
						$value = 1;
					}

					$main = array(
						"id_menu" => $rw->id_menu,
						"texto" => $rw->texto,
						"value" => $value,
						"isChecked" => boolval($value),
					);

					$child  	= array();
		
					$rsChild = $cAccion->menuGeneral($id_padre);
					
					if($rsChild->rowCount()>0){
						
						while( $rwC = $rsChild->fetch(PDO::FETCH_OBJ) ){
							$values   = array();
							$id_menu  = $rwC->id_menu;
							$rsValues = $cAccion->validateOnUsrMenu($idShow, $id_menu);
							
							$childMerge = array(
								"id_menu" => $id_menu,
								"texto" => $rwC->texto,
								"isChecked" => false,
								"value" => 0,
							);

							$values = array(
								"imp" => 0,
								"edit" => 0,
								"elim" => 0,
								"nuevo" => 0,
								"exportar" => 0,
							);
							
							if($rsValues->rowCount() > 0 ){
								$childMerge["value"] = 1;
								$childMerge["isChecked"] = true;
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

				$rows["menuActive"] = $menu;
			
			}

			$done = true;
			$msg  = "Registros consultados correctamente";

		}else{
			$msg  = "No se encuentra registro en la base de datos";
		}
		
		$resp = new mensaje();
		$resp->done  = $done;
		$resp->msg   = $msg;
		$resp->rows  = $rows;
		$resp->menu  = $menu;

		return $response->withJson($resp,200);
			
	}catch(Exception $e){
		$resp = new mensaje();
		$resp->done = $done;
		$resp->msg  = "Error: ".$e->getMessage();
		return $response->withJson($resp,400);
	}	   	   
});
