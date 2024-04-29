<?php

require_once $dir_fc."connections/conn_data.php";

class cOperadores extends BD
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
            $queryMP = "SELECT id,
                               nombre, 
                               apellido_paterno as apepa, 
                               apellido_materno as apema, 
                               email,                              
                               password, 
                               id_user_flotilla, 
                               id_tarjeta, 
                               created_at
                          FROM operadores 
                         WHERE id=".$id ." 
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
            
            if(isset($filtro['id']) && $filtro['id'] != ""){
                $condition = " AND id = '%".$filtro['id']."%' ";
            }
            if(isset($filtro['nombre']) && $filtro['nombre'] != ""){
                $condition = " AND CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno) LIKE '%".$filtro['nombre']."%' ";
            }
            if(isset($filtro['correo']) && $filtro['correo'] != ""){
                $condition = " AND u.email LIKE '%".$filtro['correo']."%' ";
            }
            
        }

        try {
            $queryUser = "SELECT 
                            id,
                            nombre, 
                            apellido_paterno, 
                            apellido_materno, 
                            email,                              
                            password, 
                            id_user_flotilla, 
                            id_tarjeta, 
                            created_at
                            FROM operadores as u
                           WHERE 1 $condition 
                           ORDER BY id DESC ".$limit;
                        
            $result = $this->conn->prepare($queryUser);
            
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
            $queryMP = "INSERT INTO operadores(
                            nombre, 
                            apellido_paterno,
                            apellido_materno, 
                            email, 
                            id_user_flotilla, 
                            id_tarjeta,
                            password,
                            created_at
                            )
                             VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
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

            $queryUpdate = "UPDATE operadores
                               SET 
                                nombre = ?,
                                apellido_paterno = ?,
                                apellido_materno = ?,
                                email = ?,
                                id_user_flotilla = ?,
                                id_tarjeta = ?,
                                password = ?,
                                updated_at = ?
                             WHERE id = ?";
            
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
    
    public function updateStatus( $tipo, $id_delete ){
        $correcto   = 1;
        $exec = $this->conn->conexion();
        
        try {
            $queryMP = "UPDATE operadores 
                           SET activo = ?
    				     WHERE id = ?";
            $result = $this->conn->prepare($queryMP);

            $exec->beginTransaction();

            $array_val = array(
                $tipo,
                $id_delete
            );

            $result->execute($array_val);
            $exec->commit();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function deleteReg( $id_user ){
        $correcto   = 2;
        try {
            $queryMP = "DELETE FROM operadores 
                              WHERE id = ".$id_user;
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            return $correcto;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    public function getRegByEmail( $email ){
        try {

            $isRepeat = false;

            $queryMP = "SELECT id as id_usuario
                          FROM operadores 
                         WHERE email ='".$email ."'
                         LIMIT 1";
                         
            $result = $this->conn->prepare($queryMP);
            $result->execute();

            if( $result->rowCount() > 0 ){

                $isRepeat = true;

            }
            return $isRepeat;
        }
        catch(\PDOException $e)
        {
            return "Error!: " . $e->getMessage();
        }
    }

    
}