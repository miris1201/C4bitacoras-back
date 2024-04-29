<?php
//Incluyendo la conexión a la base de datos
require_once $dir_fc."connections/conn_data.php";
/**
 * * Operaciones y movimientos que se realizan para el menú y otras herramientas de inciio que viene de la base de datos
 */
class cInicial extends BD
{
    function __construct()
    {
        //Esta es la que llama a la base de datos
        parent::__construct();
    }

    /*
        public function menuParents($rol){
            $queryMP = "SELECT rm.id_menu, m.texto, m.link, m.title, m.class
                           FROM ws_rol_menu rm
                           JOIN ws_menu m ON rm.id_menu = m.id
                          WHERE rm.id_rol = ".$rol." AND m.id_grupo = 0 AND m.activo = 1  ORDER BY m.orden ASC ";
            $oMP = $this->_DB->query($queryMP) or trigger_error($oMP = "Query Error: ".$this->_DB->error);
            return $oMP;
        }*/

    public function menuParents($usr){
        $estatus_filter = "";
        $contador = 0;
        $or = " ";
        try {
            $conn = new BD();
            $queryMP = "SELECT DISTINCT (rm.id_menu), m.texto, m.link, m.title, m.class
		 			  FROM ws_usuario_menu rm
		 			  JOIN ws_menu m ON rm.id_menu = m.id
		 			 WHERE m.id_grupo = 0 AND rm.id_usuario = ".$usr." AND m.activo = 1  ORDER BY m.orden ASC ";
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function menuBe($usr){

        try {
            $conn = new BD();
            $queryMP = "SELECT DISTINCT (rm.id_menu),
                               link as _tag,
                               texto as name,
                               link as route,
                               class as icon,
                               orden
                          FROM ws_usuario_menu rm
                          LEFT JOIN ws_menu m ON rm.id_menu = m.id
		 			     WHERE m.id_grupo = 0 
                           AND rm.id_usuario = ".$usr." 
                           AND m.activo = 1  ORDER BY m.orden ASC ";
                           
            $result = $conn->prepare($queryMP);
            $result->execute();
            
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function menuGeneral( $id_grupo, $id_user = "", $id_profile = "" ){

        $condition = "";

        if( $id_user != "") {
            $condition = " AND id on 
                            ( SELECT id_menu FROM ws_usuario_menu WHERE id_usuario = ".$id_user. " LIMIT 1)";
        }
        
        /*if( $id_profile != "") {
            $condition = " AND id on 
                            ( SELECT id_menu FROM ws_rol_menu WHERE id_rol = ".$id_profile. " LIMIT 1)";
        }*/

        try {
            $conn = new BD();
            $queryMP = "SELECT id as id_menu,
                               link,
                               texto,
                               class,
                               orden
                          FROM ws_menu m 
		 			     WHERE m.id_grupo = $id_grupo  
                           AND m.activo = 1  
                         ORDER BY id ASC ";
            
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function validateOnRol( $id_rol, $id_menu ){

        try {
            $conn = new BD();
            $queryMP = "SELECT imp,
                               edit,
                               elim,
                               nuevo,
                               exportar
                          FROM ws_rol_menu m 
		 			     WHERE m.id_rol = $id_rol 
                           AND m.id_menu = $id_menu";

            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function menuChild($parent, $usr){

        try {
            $conn = new BD();
            $queryMP = "SELECT link as _tag,
                               texto as name,
                               link as route,
                               class as icon,
                               orden
                          FROM ws_menu m
                         WHERE m.id_grupo > 0  AND m.activo = 1 
                           AND m.id_grupo= $parent
                           AND m.id in (select id_menu from ws_usuario_menu WHERE id_usuario = ".$usr." )
                         ORDER BY orden ASC ";
                    //echo $queryMP;
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            print "Error!: " . $e->getMessage();
        }
    }

    public function traeidMenu($nombre_menu){
        $queryMC = "SELECT id FROM ws_menu WHERE link = '$nombre_menu'";
        $oMC = $this->_DB->query($queryMC) or trigger_error($oMC = "Query Error: ".$this->_DB->error);
        return $oMC;
    }

    public function traeRolByUser($id_usuario){
        try {
            $conn = new BD();
            //$queryMP = "SELECT id_rol FROM ws_rol_usuario WHERE id_usuario = $id_usuario";
            $queryMP = "SELECT id_usuario_menu as id_rol FROM ws_usuario_menu WHERE id_usuario = $id_usuario";
            //die($queryMP);
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            print "Error!: " . $e->getMessage();
        }
    }

    public function checarRol_pagina($id_usr, $id_menu){
        try {
            $conn = new BD();
            $queryMP = "SELECT count(id_usuario_menu) as contador, imp, edit, elim, nuevo, exportar
                      FROM ws_usuario_menu WHERE id_usuario = $id_usr AND id_menu = $id_menu LIMIT 1";
            //die($queryMP);
            $result = $conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function traePremisosMenu($id_menu, $id_rol){
        $queryMC = "SELECT rm.imp, rm.edit, rm.elim, rm.nuevo, rm.exportar, m.sec
                      FROM ws_rol_menu as rm
                       LEFT JOIN ws_menu as m 
                     WHERE rm.id_menu = '$id_menu' AND rm.id_rol = ".$id_rol;
        $oMC = $this->_DB->query($queryMC) or trigger_error($oMC = "Query Error: ".$this->_DB->error);
        return $oMC;
    }

}
?>
