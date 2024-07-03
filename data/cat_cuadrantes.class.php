<?php

require_once $dir_fc."connections/conn_data.php";

class cCat_cuadrantes extends BD
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
            $queryMP = "SELECT C.id_cuadrante,
                               C.id_zona,                                
                               C.sector, 
                               C.cuadrante, 
                               C.activo,
                               Z.zona
                          FROM cat_cuadrantes C
                          LEFT JOIN cat_zona Z ON C.id_zona = Z.id_zona
                         WHERE id_cuadrante = ".$id ." 
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
            
            if(isset($filtro['id_zona']) && $filtro['id_zona'] != ""){
                $condition .= " AND C.id_zona = ".$filtro['id_zona']." ";
            }

            if(isset($filtro['cuadrante']) && $filtro['cuadrante'] != ""){
                $condition .= " AND cuadrante LIKE '%".$filtro['cuadrante']."%' ";
            }
        }

        try {
            $query = "  SELECT id_cuadrante,
                            C.id_zona, 
                            sector,
                            cuadrante,
                            C.activo,
                            Z.zona 
                            FROM cat_cuadrantes C 
                             LEFT JOIN cat_zona Z ON C.id_zona = Z.id_zona
                            WHERE 1 $condition 
                           ORDER BY C.id_zona ASC, id_cuadrante DESC ".$limit;
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
            $queryMP = "INSERT INTO cat_cuadrantes(
                            id_zona, 
                            sector,
                            cuadrante)
                             VALUES (
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

            $queryUpdate = "UPDATE cat_cuadrantes
                               SET id_zona = ?,
                                   sector = ?,
                                   cuadrante = ?
                             WHERE id_cuadrante = ?";
            
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
            $queryMP = "UPDATE cat_cuadrantes 
                           SET activo = ?
    				     WHERE id_cuadrante = ?";
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
            $queryMP = "DELETE FROM cat_cuadrantes 
                              WHERE id_cuadrante = ".$id;
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    

    public function getCatCuadrante( $sector ){
        try {
            $query = "SELECT id_cuadrante, 
                             cuadrante, activo
                        FROM cat_cuadrantes 
                       WHERE activo = 1
                         AND sector = ". $sector ."
                       ORDER BY id_cuadrante ASC";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

    public function getCatSector( $sector ){
        try {
            $query = "SELECT sector, activo
                        FROM cat_cuadrantes
                        WHERE activo = 1
                         AND id_zona = ". $sector ."
                       GROUP BY sector ";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }
   
    public function getCatZona(){
        try {
            $query = "SELECT id_zona, zona, activo
                        FROM cat_zona 
                        WHERE activo = 1";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }
}