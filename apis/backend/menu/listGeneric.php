<?php
$dir_fc = "../";
include_once $dir_fc.'data/inicial.class.php';	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/menu/listGeneric',function(Request $request, Response $response){

	$id_rol  	 = $request->getParam('id_rol');
	$id_usuario  = $request->getParam('id_usuario');

	$cAccion =	new cInicial();

	class mensaje {
		public $done;
		public $mensaje;
		public $menu;
	}
	
	
	$done  	 = false;
	$rows	 = array();
	$mensaje = "noValido";
	
	try{

		if( is_null($id_rol) || !isset($id_rol)){
			throw new Exception(" Se tiene que enviar el perfil ");
		}

		$lista  = $cAccion->menuGeneral(0);

		if($lista->rowCount()>0){

			while ($rw = $lista->fetch(PDO::FETCH_OBJ)){		
				
				$id_padre 	= $rw->id_menu; 
				$value		= 0;
				$rsValMain  = $cAccion->validateOnRol($id_rol, $id_padre);
				
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
						$rsValues = $cAccion->validateOnRol($id_rol, $id_menu);
						
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
				$rows[] 	= $main;
			}

			$done = true;	
			$mensaje   = "Menú consultado correctamente.";

		}

		$resp = new mensaje();
		$resp->done 	 = $done;
		$resp->menu      = $rows;
		$resp->mensaje   = $mensaje;
		

		return $response->withJson($resp,200);
		
	}catch(PDOException $e){
		$resp = new mensaje();
		$resp->done = $done;
		$resp->mensaje = $e->getMessage();
		return $response->withJson($resp,400);
	}	   	   
});

?>