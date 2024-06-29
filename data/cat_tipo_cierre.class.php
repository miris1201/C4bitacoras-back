<?php

require_once $dir_fc."connections/conn_data.php";

class cCat_t_cierre extends BD
{
    private $conn;

    function __construct()
    {
        //Esta es la que llama a la base de datos
        //parent::__construct();
        $this->conn = new BD();
    }

    
    public function getRegbyid( $id ){
        try {
            $queryMP = "SELECT id_tipo_cierre,
                               descripcion,
                               activo
                          FROM cat_tipo_cierre 
                         WHERE id_tipo_cierre = ".$id ." 
                         LIMIT 1";
                         
            $result = $this->conn->prepare($queryMP);
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function getAllReg($limite, $inicio, $fin, $filtro)
    {
        $limit      = "";
        $condition  = "";
        
        if ($limite == 1){ $limit = " LIMIT ".$inicio.", ".$fin;}
        
        if (is_array($filtro)){
            
            if(isset($filtro['descripcion']) && $filtro['descripcion'] != ""){
                $condition = " WHERE descripcion LIKE '%".$filtro['descripcion']."%' ";
            }
            
        }

        try {
            $query = "  SELECT id_tipo_cierre,
                            descripcion,
                            activo
                            FROM cat_tipo_cierre
                             $condition 
                           ORDER BY id_tipo_cierre DESC ".$limit;
                // echo $query;
            $result = $this->conn->prepare($query);
            
            $result->execute();
            return $result;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function insertReg( $data ){
        $correcto= 1;
        
        $exec = $this->conn->conexion();
        try {
            $queryMP = "INSERT INTO cat_tipo_cierre(
                            descripcion )
                             VALUES (
                            ?)";

            $result = $this->conn->prepare($queryMP);
            $exec->beginTransaction();

            $result->execute($data);

            if ($correcto == 1){
                $correcto= $exec->lastInsertId();
            }

            $exec->commit();
            return $correcto;
        }
        catch(\PDOException $e)
        {
            $exec->rollBack();
            return "Error!: " . $e->getMessage();
        }
    }
    
    public function updateReg( $data ){
        $correcto   = 1;
        $exec       = $this->conn->conexion();

        try {

            $queryUpdate = "UPDATE cat_tipo_cierre
                               SET descripcion = ?
                             WHERE id_tipo_cierre = ?";
            
            $result = $this->conn->prepare($queryUpdate);

            $exec->beginTransaction();
            $result->execute($data);

            $exec->commit();
        }catch (\PDOException $e){
            $exec->rollBack();
            $correcto =  "Error!: " . $e->getMessage();
        }
        return $correcto;
    }
    
    public function updateStatus( $data ){
        $correcto   = 1;
        $exec = $this->conn->conexion();
        
        try {
            $queryMP = "UPDATE cat_tipo_cierre 
                           SET activo = ?
    				     WHERE id_tipo_cierre = ?";
            $result = $this->conn->prepare($queryMP);

            $exec->beginTransaction();

            $result->execute($data);
            $exec->commit();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function deleteReg( $id ){
        $correcto   = 2;
        try {
            $queryMP = "DELETE FROM cat_tipo_cierre 
                              WHERE id_tipo_cierre = ".$id;
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    

    public function getCatTipoCierre(){
        try {
            $query = "SELECT id_tipo_cierre, 
                             descripcion, 
                             activo
                        FROM cat_tipo_cierre 
                       WHERE activo = 1
                       ORDER BY id_tipo_cierre ASC";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

}