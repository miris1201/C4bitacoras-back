<?php
$dir_fc = "../";
include_once $dir_fc.'data/servicios.class.php';	
require_once $dir_fc."common/function.class.php";	

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

$app->post('/registros/servicios/insertupdate',function(Request $request, Response $response){

	$id_update 	= $request->getParam('id_update');

	$folio			 = $request->getParam('folio');
	$id_usuario		 = $request->getParam('id_usuario');
	$id_zona		 = $request->getParam('id_zona_b');
	$fecha			 = $request->getParam('fecha');
	$hora			 = $request->getParam('hora');
	$calle			 = $request->getParam('calle');
	$calle1			 = $request->getParam('calle1');
	$id_colonia		 = $request->getParam('id_colonia');
	$nombre 	     = $request->getParam('nombre');
	$telefono		 = $request->getParam('telefono');
	$observaciones 	 = $request->getParam('observaciones');
	$id_emergencia 	 = $request->getParam('id_emergencia');
	$id_operativo 	 = $request->getParam('id_operativo');
	$otros_operativos = $request->getParam('otros_operativos');
	$id_llamada 	 = $request->getParam('id_llamada');
	$id_turno    	 = $request->getParam('id_turno');
	
	
	$placas    	 	 = $request->getParam('placas');
	$modelo    	 	 = $request->getParam('modelo');
	$marca    	 	 = $request->getParam('marca');
	$subMarca    	 = $request->getParam('subMarca');
	$color    		 = $request->getParam('color');
	$serie    	 	 = $request->getParam('serie');
	
	$cFn 	 = new cFunction();
	$cAccion = new cServicios();
	
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
		   $telefono != "" &&
		   $observaciones != "" &&
		   $calle != "" &&
		   $calle1 != "" &&
		   !is_numeric($id_zona) &&
		   !is_numeric($id_turno) &&
		   !is_numeric($id_emergencia) &&
		   !is_numeric($id_llamada) &&
		   !is_numeric($id_operativo) &&
		   !is_numeric($id_colonia) 
		   ){
			throw new Exception ("Datos incompletos, validar datos de envío");

		}

		$folio = $cAccion->getFolioMax();
		$folioDuplicado = $cAccion->checkFolioDuplicado( $folio );
		if ($folioDuplicado > 0 ) {
			$folio = $cAccion->getFolioMax();
		}

		$fecha_cap = date("Y-m-d H:i:s");

		if ($id_operativo == 16 
			&& ($otros_operativos == "" 
			|| $otros_operativos == null)) {
			throw new Exception ("Especifica el tipo de operativo.");
		}

		if ($id_emergencia == 36 || $id_emergencia == 37 &&
			($placas == null ||
			$modelo == null ||
			$marca == null ||
			$subMarca == null ||
			$color == null ||
			$serie == null )
			) {
			throw new Exception ("Faltan los datos del vehiculo");
		}

		$data = array(
			$folio,
			$fecha_cap,
			$id_usuario,
			$id_zona,
			1, 			
			$fecha,
			$hora,
			$calle,
			$calle1,
			$id_colonia,
			$nombre,
			$telefono,
			$observaciones, 
			$id_emergencia,
			$id_operativo,
			$otros_operativos,
            $id_llamada,
            $id_turno
		);

		if(!is_numeric($id_update)){
			throw new Exception ("El elemento id_update debe de ser numérico");
		}
			
		$insert    = $cAccion->insertReg( $data );
		$strResp   = " insertado ";
		$id_reg    = $insert; 	


		if ($id_emergencia == 36 || $id_emergencia == 37) {
			$dataV = array(
				$id_reg,
				$placas,
				$modelo,
				$marca,
				$subMarca,
				$color,
				$serie
			);

			$insertV    = $cAccion->insertRegVehicular( $dataV );
		}
		
		
		if(is_numeric($insert)){
			$msg   = "Registro $strResp correctamente";
			$done  = true;
			
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
		return $response->withJson($resp,400);

	}	   	   
});
