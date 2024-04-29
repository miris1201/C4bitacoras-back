<?php
$dir_fc = "../";
include_once $dir_fc.'data/inicial.class.php';	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/menu/list',function(Request $request, Response $response){
	
	$id_rol  	 = $request->getParam('id_rol');
	$id_usuario  = $request->getParam('id_usuario');

	$cAccion =	new cInicial();
	
	$lista  = $cAccion->menuBe($id_usuario);

	class mensaje {
		public $respuesta;
		public $mensaje;
		public $menu;
	}
   
	try{
		
		$respuesta = 0;
		$rows	   = array();
		$mensaje   = "noValido";
		
		if($lista->rowCount()>0){

			while ($rw = $lista->fetch(PDO::FETCH_ASSOC)){		
				
				$id_padre 	= $rw["id_menu"]; 
				$child  	= array();
				
				$rsChild = $cAccion->menuChild($id_padre, $id_usuario);
				
				if($rsChild->rowCount()>0){
					
					while($rwC = $rsChild->fetch(PDO::FETCH_OBJ)){
						$child[] = $rwC;
					}
										
					$rw["_children"] = $child;
				}
				$rows[] 	= $rw;
			}

			$respuesta = 1;	
			$mensaje   = "esValido";

		}

		$resp = new mensaje();
		$resp->menu      = $rows;
		$resp->respuesta = $respuesta;
		$resp->mensaje   = $mensaje;
		

		return $response->withJson($resp,200);
		
	}catch(PDOException $e){
		$resp = new mensaje();
		$resp->respuesta= "error";
		$resp->mensaje = $e->getMessage();
		return $response->withJson($resp,200);
	}	   	   
});
