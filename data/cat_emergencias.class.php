<?php

require_once $dir_fc."connections/conn_data.php";

class cCat_emergencias extends BD
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
            $queryMP = "SELECT id_emergencia,
                               E.id_departamento, 
                               descripcion,
                               E.activo,  
                               D.departamento
                            FROM cat_emergencia E
                            LEFT JOIN cat_departamento D on E.id_departamento = D.id_departamento
                         WHERE id_emergencia = ".$id ." 
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
            
            if(isset($filtro['id_departamento']) && $filtro['id_departamento'] != ""){
                $condition .= " AND E.id_departamento = ".$filtro['id_departamento']." ";
            }

            if(isset($filtro['descripcion']) && $filtro['descripcion'] != ""){
                $condition .= " AND descripcion LIKE '%".$filtro['descripcion']."%' ";
            }
            
        }

        try {
            $query = "  SELECT id_emergencia,
                            E.id_departamento,
                            descripcion,
                            E.activo,
                            D.departamento
                            FROM cat_emergencia E
                            LEFT JOIN cat_departamento D on E.id_departamento = D.id_departamento
                            WHERE 1 $condition 
                           ORDER BY id_emergencia DESC ".$limit;
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
            $queryMP = "INSERT INTO cat_emergencia(
                            id_departamento,
                            descripcion )
                             VALUES (
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

            $queryUpdate = "UPDATE cat_emergencia
                               SET id_departamento = ?,
                                   descripcion     = ?
                             WHERE id_emergencia   = ?";
            
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
            $queryMP = "UPDATE cat_emergencia 
                           SET activo = ?
    				     WHERE id_emergencia = ?";
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
            $queryMP = "DELETE FROM cat_emergencia 
                              WHERE id_emergencia = ".$id;
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }
    

    public function getCatEmergencia(){
        try {
            $query = "SELECT id_emergencia, 
                             descripcion,
                             D.abreviatura,
                             concat_ws(' - ', D.abreviatura, descripcion) as emergencias
                        FROM cat_emergencia E
                        LEFT JOIN cat_departamento D ON E.id_departamento = D.id_departamento
                       WHERE E.activo = 1
                       ORDER BY descripcion ASC";

            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;

        }catch (\PDOException $e){
            return "Error!: " . $e->getMessage();
        }
    }

}