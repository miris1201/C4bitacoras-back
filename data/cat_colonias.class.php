<?php

require_once $dir_fc."connections/conn_data.php";

class cCat_colonias extends BD
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
            $queryMP = "SELECT id_colonia,
                               nombre, 
                               tipo,
                               sector, 
                               region,
                               activo
                          FROM cat_colonia 
                         WHERE id_colonia = ".$id ." 
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
            
            if(isset($filtro['id_colonia']) && $filtro['id_colonia'] != ""){
                $condition = " AND id_colonia = '%".$filtro['id_colonia']."%' ";
            }
            if(isset($filtro['nombre']) && $filtro['nombre'] != ""){
                $condition = " AND nombre LIKE '%".$filtro['nombre']."%' ";
            }
            
        }

        try {
            $query = "  SELECT id_colonia,
                            nombre, 
                            tipo,
                            sector, 
                            region,
                            activo
                            FROM cat_colonia as u
                           WHERE 1 $condition 
                           ORDER BY id_colonia DESC ".$limit;
                        
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
            $queryMP = "INSERT INTO cat_colonia(
                            nombre, 
                            tipo,
                            sector, 
                            region )
                             VALUES (
                            ?,
                            ?,
                            ?,
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

            $queryUpdate = "UPDATE cat_colonia
                               SET nombre = ?,
                                   tipo = ?,
                                   sector = ?,
                                   region = ?
                             WHERE id_colonia = ?";
            
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
            $queryMP = "UPDATE cat_colonia 
                           SET activo = ?
    				     WHERE id_colonia = ?";
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
            $queryMP = "DELETE FROM cat_colonia 
                              WHERE id_colonia = ".$id;
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    

    public function getCatColonias( $id_zona ){
        try {
            $query = "SELECT id_colonia, 
                             CONCAT_WS(' - ', tipo, colonia) AS colonias,
                        FROM cat_colonia 
                       WHERE activo = 1
                         AND id_zona = ". $id_zona ."
                       ORDER BY id_colonia ASC";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }
}